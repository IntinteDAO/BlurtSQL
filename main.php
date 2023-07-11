#!/usr/bin/php

<?php

require("config.php");
require("functions.php");
$handle = init_database($database_sqlite3_filename);
$current_block = get_current_local_block($handle);
$block_data = get_block($current_block);
$ops_data = decode_ops($block_data);
$last_known_block = last_known_block();

for($j=$current_block; $j<=$last_known_block; $j++) {
$percent = number_format(round(($current_block*100)/$last_known_block, 5), 5, '.', '');
echo 'Current Block: '.$current_block.' / '.$last_known_block.' ('.$percent.'%)'.PHP_EOL;

for($i=0; $i<=count($ops_data)-1; $i++) {
	$var = $ops_data[$i][1];
    if($ops_data[$i][0]=='vote') {
	echo 'Adding Vote'.PHP_EOL;
	push_vote($current_block, $var['voter'], $var['author'], $var['permlink'], $var['weight'], $handle);
    } else if($ops_data[$i][0]=='transfer') {
	echo 'Adding Transfer'.PHP_EOL;
	push_transfer($current_block, $var['from'], $var['to'], $var['amount'], $var['memo'], $handle);
    } else if($ops_data[$i][0]=='comment') {
	echo 'Adding Comment'.PHP_EOL;
	if($body_truncate==1) {
		$var['body']='';
	}
	if((!empty($var['author'])) && (!empty($var['permlink']))) {
		push_comment($current_block, $var['parent_author'], $var['parent_permlink'], $var['author'], $var['permlink'], $var['title'], $var['body'], $handle);
	}
    } else if($ops_data[$i][0]=='witness_update') {
	echo 'Ignoring Witness Update'.PHP_EOL;
    } else if($ops_data[$i][0]=='account_witness_vote') {
	echo 'Adding Account Witness Vote'.PHP_EOL;
	push_account_witness_vote($current_block, $var['account'], $var['witness'], $var['approve'], $handle);
    } else if($ops_data[$i][0]=='account_create') {
	echo 'Adding Account'.PHP_EOL;
	push_account_create($current_block, $var['creator'], $var['new_account_name'], $var['fee'], $handle);
    } else if($ops_data[$i][0]=='withdraw_vesting') {
	echo 'Adding Power Down'.PHP_EOL;
	push_withdraw_vesting($current_block, $var['account'], $var['vesting_shares'], $handle);
    } else if($ops_data[$i][0]=='account_witness_proxy') {
	echo 'Adding Account Witness Proxy'.PHP_EOL;
	push_account_witness_proxy($current_block, $var['account'], $var['proxy'], $handle);
    } else if($ops_data[$i][0]=='custom_json') {
	echo 'Adding Custom JSON'.PHP_EOL;
	push_custom_json($current_block, $var['required_auths'], $var['required_posting_auths'], $var['id'], $var['json'], $handle);
    } else if($ops_data[$i][0]=='delete_comment') {
	echo 'Adding Delete Comment'.PHP_EOL;
	push_delete_comment($current_block, $var['author'], $var['permlink'], $handle);
    } else if($ops_data[$i][0]=='transfer_to_vesting') {
	echo 'Adding Transfer to Vesting'.PHP_EOL;
	push_transfer_to_vesting($current_block, $var['from'], $var['to'], $var['amount'], $handle);
    } else if($ops_data[$i][0]=='claim_account') {
	if($dont_claim_account==0) {
	    echo 'Adding Claim Account'.PHP_EOL;
	    push_claim_account($current_block, $var['creator'], $var['fee'], $var['extensions'], $handle);
	}
    } else if($ops_data[$i][0]=='create_claimed_account') {
	echo 'Adding Account (Claim)'.PHP_EOL;
	$var['fee']='';
	push_account_create($current_block, $var['creator'], $var['new_account_name'], $var['fee'], $handle);
    } else if($ops_data[$i][0]=='delegate_vesting_shares') {
	echo 'Adding Delegate Vesting Shares'.PHP_EOL;
	push_delegate_vesting_shares($current_block, $var['delegator'], $var['delegatee'], $var['vesting_shares'], $handle);
    } else if($ops_data[$i][0]=='create_proposal') {
	echo 'Adding Proposal'.PHP_EOL;
	push_create_proposal($current_block, $var['creator'], $var['receiver'], $var['start_date'], $var['end_date'], $var['daily_pay'], $var['subject'], $var['permlink'], $handle);
    } else if($ops_data[$i][0]=='update_proposal_votes') {
	echo 'Adding Update Proposal Votes'.PHP_EOL;
	push_update_proposal_votes($current_block, $var['voter'], $var['proposal_ids'], $var['approve'], $var['extensions'], $handle);
    } else if($ops_data[$i][0]=='set_withdraw_vesting_route') {
	echo 'Adding Set Withdraw Vesting Route'.PHP_EOL;
	push_set_withdraw_vesting_route($current_block, $var['from_account'], $var['to_account'], $var['percent'], $var['auto_vest'], $handle);
    } else if($ops_data[$i][0]=='transfer_to_savings') {
	echo 'Adding Transfer to Savings'.PHP_EOL;
	push_transfer_to_savings($current_block, $var['from'], $var['to'], $var['amount'], $var['memo'], $handle);
    } else if($ops_data[$i][0]=='transfer_from_savings') {
	echo 'Adding Transfer from Savings'.PHP_EOL;
	push_transfer_from_savings($current_block, $var['from'], $var['request_id'], $var['to'], $var['amount'], $var['memo'], $handle);
    } else if($ops_data[$i][0]=='account_update') {
	echo 'IGNORING ACCOUNT UPDATE'.PHP_EOL;
    } else if($ops_data[$i][0]=='change_recovery_account') {
	echo 'Adding Change Recovery Account'.PHP_EOL;
	push_change_recovery_account($current_block, $var['account_to_recover'], $var['new_recovery_account'], $handle);
    } else if($ops_data[$i][0]=='witness_set_properties') {
	echo 'IGNORING WITNESS SET PROPERTIES'.PHP_EOL;
    } else if($ops_data[$i][0]=='claim_reward_balance') {
	echo 'IGNORING CLAIM REWARD BALANCE'.PHP_EOL;
    } else if($ops_data[$i][0]=='decline_voting_rights') {
	echo 'IGNORING DECLINE VOTING RIGHTS'.PHP_EOL;
    } else if($ops_data[$i][0]=='comment_options') {
	echo 'IGNORING COMMENT OPTIONS'.PHP_EOL;
    } else if($ops_data[$i][0]=='cancel_transfer_from_savings') {
	echo 'IGNORING CANCEL TRANSFER FROM SAVINGS'.PHP_EOL;
    } else if($ops_data[$i][0]=='request_account_recovery') {
        echo 'IGNORING REQUEST ACCOUNT RECOVERY'.PHP_EOL;
    } else if($ops_data[$i][0]=='recover_account') {
        echo 'IGNORING RECOVER ACCOUNT'.PHP_EOL;
    } else if($ops_data[$i][0]=='custom') {
        echo 'IGNORING CUSTOM'.PHP_EOL;
    } else if($ops_data[$i][0]=='remove_proposal') {
        echo 'IGNORING REMOVE PROPOSAL'.PHP_EOL;
    } else {
	print_r($var);
	die('Unknown OPS '.$ops_data[$i][0]);
    }
}

update_block($handle);
$current_block++;
$block_data = get_block($current_block);
$ops_data = decode_ops($block_data);

if($current_block == $last_known_block) {
    sleep(10);
    $last_known_block = last_known_block();
}

}

?>
