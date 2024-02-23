-- Doctrine Migration File Generated on 2024-02-22 20:16:39

-- Version sql\migrations\Version20240222201631
CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1;
ALTER TABLE users ALTER created_date SET DEFAULT CURRENT_TIMESTAMP;
