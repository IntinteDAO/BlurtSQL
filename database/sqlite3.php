<?php

function init_database($file) {
    return new SQLite3($file);
}

function get_current_local_block($handle) {
    return $handle->querySingle('SELECT id FROM current_block');
}

function update_block($handle) {
    $handle->querySingle('UPDATE current_block SET id=id+1');
}

function push_vote($block_id, $voter, $author, $permlink, $weight, $handle) {
    $handle->querySingle("INSERT INTO vote (block_id, voter, author, permlink, weight) VALUES ('$block_id', '$voter', '$author', '$permlink', '$weight')");
}

function push_transfer($block_id, $from, $to, $amount, $memo, $handle) {
    $memo = str_replace("'", "''", $memo);
    $handle->querySingle("INSERT INTO transfer (block_id, `from`, `to`, amount, memo) VALUES ('$block_id', '$from', '$to', '$amount', '$memo')");
}

function push_comment($block_id, $parent_author, $parent_permlink, $author, $permlink, $title, $body, $handle) {
    $title = str_replace("'", "''", $title);
    $body = str_replace("'", "''", $body);
    $handle->querySingle("INSERT INTO comment (block_id, parent_author, parent_permlink, author, permlink, title, body) VALUES ('$block_id', '$parent_author', '$parent_permlink', '$author', '$permlink', '$title', '$body')");
}

function push_account_witness_vote($block_id, $account, $witness, $approve, $handle) {
    $handle->querySingle("INSERT INTO account_witness_vote (block_id, account, witness, approve) VALUES ('$block_id', '$account', '$witness', '$approve')");
}

function push_account_create($block_id, $creator, $new_account_name, $fee, $handle) {
    $handle->querySingle("INSERT INTO account_create (block_id, creator, new_account_name, fee) VALUES ('$block_id', '$creator', '$new_account_name', '$fee')");
}

function push_withdraw_vesting($block_id, $account, $vesting_shares, $handle) {
    $handle->querySingle("INSERT INTO withdraw_vesting (block_id, account, vesting_shares) VALUES ('$block_id', '$account', '$vesting_shares')");
}

function push_account_witness_proxy($block_id, $account, $proxy, $handle) {
    $handle->querySingle("INSERT INTO account_witness_proxy (block_id, account, proxy) VALUES ('$block_id', '$account', '$proxy')");
}

function push_custom_json($block_id, $required_auths, $required_posting_auths, $id, $json, $handle) {
    $required_auths = json_encode($required_auths);
    $required_posting_auths = json_encode($required_posting_auths);
    $json = str_replace("'", "''", $json);
    $handle->querySingle("INSERT INTO custom_json (block_id, required_auths, required_posting_auths, id, json) VALUES ('$block_id', '$required_auths', '$required_posting_auths', '$id', '$json')");
}

function push_delete_comment($block_id, $author, $permlink, $handle) {
    $handle->querySingle("INSERT INTO delete_comment (block_id, author, permlink) VALUES ('$block_id', '$author', '$permlink')");
}

function push_transfer_to_vesting($block_id, $from, $to, $amount, $handle) {
    $handle->querySingle("INSERT INTO transfer_to_vesting (block_id, `from`, `to`, amount) VALUES ('$block_id', '$from', '$to', '$amount')");
}

function push_claim_account($block_id, $creator, $fee, $extensions, $handle) {
    $extensions = str_replace("'", "''", json_encode($extensions));
    $handle->querySingle("INSERT INTO claim_account (block_id, creator, fee, extensions) VALUES ('$block_id', '$creator', '$fee', '$extensions')");
}

function push_delegate_vesting_shares($block_id, $delegator, $delegatee, $vesting_shares, $handle) {
    $handle->querySingle("INSERT INTO delegate_vesting_shares (block_id, delegator, delegatee, vesting_shares) VALUES ('$block_id', '$delegator', '$delegatee', '$vesting_shares')");
}

function push_create_proposal($block_id, $creator, $receiver, $start_date, $end_date, $daily_pay, $subject, $permlink, $handle) {
    $handle->querySingle("INSERT INTO create_proposal (block_id, creator, receiver, start_date, end_date, daily_pay, subject, permlink) VALUES ('$block_id', '$creator', '$receiver', '$start_date', '$end_date', '$daily_pay', '$subject', '$permlink')");
}

function push_update_proposal_votes($block_id, $voter, $proposal_ids, $approve, $extensions, $handle) {
    $proposal_ids = json_encode($proposal_ids);
    $extensions = json_encode($extensions);
    $handle->querySingle("INSERT INTO update_proposal_votes (block_id, voter, proposal_ids, approve, extensions) VALUES ('$block_id', '$voter', '$proposal_ids', '$approve', '$extensions')");
}

function push_set_withdraw_vesting_route($block_id, $from_account, $to_account, $percent, $auto_vest, $handle) {
    $handle->querySingle("INSERT INTO set_withdraw_vesting_route (block_id, from_account, to_account, percent, auto_vest) VALUES ('$block_id', '$from_account', '$to_account', '$percent', '$auto_vest')");
}

function push_transfer_to_savings($block_id, $from, $to, $amount, $memo, $handle) {
    $handle->querySingle("INSERT INTO transfer_to_savings (block_id, `from`, `to`, amount, memo) VALUES ('$block_id', '$from', '$to', '$amount', '$memo')");
}

function push_transfer_from_savings($block_id, $from, $request_id, $to, $amount, $memo, $handle) {
    $handle->querySingle("INSERT INTO transfer_from_savings (block_id, `from`, request_id, `to`, amount, memo) VALUES ('$block_id', '$from', '$request_id', '$to', '$amount', '$memo')");
}

function push_change_recovery_account($block_id, $account_to_recover, $new_recovery_account, $handle) {
    $handle->querySingle("INSERT INTO change_recovery_account (block_id, account_to_recover, new_recovery_account) VALUES ('$block_id', '$account_to_recover', '$new_recovery_account')");
}