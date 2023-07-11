BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "vote" (
	"block_id"	INTEGER,
	"voter"	TEXT,
	"author"	TEXT,
	"permlink"	TEXT,
	"weight"	INTEGER
);
CREATE TABLE IF NOT EXISTS "transfer" (
	"block_id"	INTEGER,
	"from"	TEXT,
	"to"	TEXT,
	"amount"	TEXT,
	"memo"	TEXT
);
CREATE TABLE IF NOT EXISTS "comment" (
	"block_id"	INTEGER,
	"parent_author"	TEXT,
	"parent_permlink"	TEXT,
	"author"	TEXT,
	"permlink"	TEXT,
	"title"	TEXT,
	"body"	TEXT
);
CREATE TABLE IF NOT EXISTS "current_block" (
	"id"	INTEGER
);
CREATE TABLE IF NOT EXISTS "account_witness_vote" (
	"block_id"	INTEGER,
	"account"	TEXT,
	"witness"	TEXT,
	"approve"	INTEGER
);
CREATE TABLE IF NOT EXISTS "account_create" (
	"block_id"	INTEGER,
	"creator"	TEXT,
	"new_account_name"	TEXT,
	"fee"	TEXT
);
CREATE TABLE IF NOT EXISTS "withdraw_vesting" (
	"block_id"	INTEGER,
	"account"	TEXT,
	"vesting_shares"	TEXT
);
CREATE TABLE IF NOT EXISTS "account_witness_proxy" (
	"block_id"	INTEGER,
	"account"	TEXT,
	"proxy"	TEXT
);
CREATE TABLE IF NOT EXISTS "custom_json" (
	"block_id"	INTEGER,
	"required_auths"	TEXT,
	"required_posting_auths"	TEXT,
	"id"	TEXT,
	"json"	TEXT
);
CREATE TABLE IF NOT EXISTS "delete_comment" (
	"block_id"	INTEGER,
	"author"	TEXT,
	"permlink"	TEXT
);
CREATE TABLE IF NOT EXISTS "transfer_to_vesting" (
	"block_id"	INTEGER,
	"from"	TEXT,
	"to"	TEXT,
	"amount"	TEXT
);
CREATE TABLE IF NOT EXISTS "claim_account" (
	"block_id"	INTEGER,
	"creator"	TEXT,
	"fee"	TEXT,
	"extensions"	TEXT
);
CREATE TABLE IF NOT EXISTS "delegate_vesting_shares" (
	"block_id"	INTEGER,
	"delegator"	TEXT,
	"delegatee"	TEXT,
	"vesting_shares"	TEXT
);
CREATE TABLE IF NOT EXISTS "create_proposal" (
	"block_id"	INTEGER,
	"creator"	TEXT,
	"receiver"	TEXT,
	"start_date"	TEXT,
	"end_date"	TEXT,
	"daily_pay"	TEXT,
	"subject"	TEXT,
	"permlink"	TEXT
);
CREATE TABLE IF NOT EXISTS "update_proposal_votes" (
	"block_id"	INTEGER,
	"voter"	TEXT,
	"proposal_ids"	TEXT,
	"approve"	INTEGER,
	"extensions"	TEXT
);
CREATE TABLE IF NOT EXISTS "set_withdraw_vesting_route" (
	"block_id"	INTEGER,
	"from_account"	TEXT,
	"to_account"	TEXT,
	"percent"	INTEGER,
	"auto_vest"	TEXT
);
CREATE TABLE IF NOT EXISTS "transfer_to_savings" (
	"block_id"	INTEGER,
	"from"	TEXT,
	"to"	TEXT,
	"amount"	TEXT,
	"memo"	TEXT
);
CREATE TABLE IF NOT EXISTS "transfer_from_savings" (
	"block_id"	INTEGER,
	"from"	TEXT,
	"request_id"	INTEGER,
	"to"	TEXT,
	"amount"	TEXT,
	"memo"	TEXT
);
INSERT INTO "current_block" VALUES (0);
COMMIT;
