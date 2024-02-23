-- Doctrine Migration File Generated on 2024-02-22 18:37:09

-- Version sql\migrations\Version20240222183557
ALTER TABLE users DROP updated_date;
ALTER TABLE users ALTER created_date SET DEFAULT CURRENT_TIMESTAMP;
