create table clients
(
    client uuid primary key, 	-- ID клієнта
    client_couch id uuid,	-- ID категорії клієнта
    name varchar(64),		-- Ім’я клієнта
    desc longtext,		-- біографія клієнту
    gender boolean,		-- true — чоловік, false — жінка
    value integer		-- Оцінка
);
--1
SELECT client_couch_id
FROM clients
WHERE gender = true AND value > 5
GROUP BY client_couch_id
HAVING MIN(value) > 5;

--2

--Modify Table Structures:
--Add a hash column in both tables (in both the current and the other database) for the biography (`desc`) text. The hash will be used for efficient comparison.

ALTER TABLE db1.clients ADD COLUMN desc_hash CHAR(64);
ALTER TABLE db2.clients ADD COLUMN desc_hash CHAR(64);

--Compute and Store Hashes:
--Compute the SHA-2 hashes for existing biographies using an update query in both databases.

UPDATE db1.clients SET desc_hash = SHA2(desc, 256);
UPDATE db2.clients SET desc_hash = SHA2(desc, 256);

--
--Perform Quick Search Across Databases:
--To find an exact match of a biography, compute the hash of the biography text you're searching for and then query the hash column.

SELECT *
FROM db1.clients as db1cls
JOIN db2.clients as db2cls on db1cls.desc_hash = db2cls.desc_hash
WHERE db1cls.desc_hash = SHA2('Biography text to search for', 256);

