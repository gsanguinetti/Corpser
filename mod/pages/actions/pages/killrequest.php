<?php
/**
 * A user's page participation request
 *
 * @uses $vars['invitations'] Array of ElggGroups
 */
gatekeeper();
$page_guid = get_input('page_guid');
$invited_guid = get_input('invited_guid');

$page = get_entity($page_guid);
		if(!$page)
		{
			register_error(elgg_echo("pages_tools:no_story"));
			forward();
		}

$relation = check_entity_relationship($invited_guid, 'request_participation_to', $page_guid);
if(!$relation)
{
	register_error(elgg_echo("pages_tools:error:no_invited"));
	forward(REFERER);
}

//Lets wait a little in order to resend more invitation to the same person (30 minutes)
if(time()<($relation->time_created+(60 * 30)))
{
	register_error(elgg_echo("pages_tools:wait_to_resend_invitation"));
	forward(REFERER);
}

if(!delete_relationship($relation->id))
{
	register_error(elgg_echo("pages_tools:cannot_resend_invitation"));
	forward(REFERER);
}
else
{
	system_message(elgg_echo("pages_tools:success_kill_invitation"));
	forward(REFERER);
}
