CREATE TABLE dsppgm_db.KEMRI_pay_structure(
    Designation VARCHAR(255),
    Job_group_title VARCHAR(255),
    Job_group_kmr VARCHAR(255),
    Step VARCHAR(255),
    Basic_salary INT NULL,
    House_allowance INT NULL,
    Commuter_allowance INT NULL,
    Extraneous_allowance INT NULL,
    Risk_allowance INT NULL,
    Health_worker_allowance INT NULL,
    Emergency_call_allowance INT NULL,
    Non_practice_allowance INT NULL,
    Nursing_service_allowance INT NULL,
    Leave_allowance INT ,
    Gross_monthly_pay INT,
    Gratuity INT,
    Insurance INT,
    Gross_monthly_pay_and_benefits_contract INT,
    Gross_monthly_pay_and_benefits_pnp INT,
    Gross_annual_pay_and_benefits INT
)
--@block
LOAD DATA INFILE 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/modified_personnel.csv'
INTO TABLE dsppgm_db.KEMRI_pay_structure
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(Designation, Job_group_title, Job_group_kmr, Step, Basic_salary, House_allowance, Commuter_allowance, Extraneous_allowance, Risk_allowance,
Health_worker_allowance,Emergency_call_allowance, Non_practice_allowance, Nursing_service_allowance, Leave_allowance, Gross_monthly_pay, Gratuity, 
Insurance,Gross_monthly_pay_and_benefits_contract,Gross_monthly_pay_and_benefits_pnp,Gross_annual_pay_and_benefits, @dummy_variable)
SET 
    Designation = NULLIF(Designation, ''),
    Job_group_title = NULLIF(Job_group_title, ''),
    Job_group_kmr = NULLIF(Job_group_kmr, ''),
    Step = NULLIF(Step, ''),
    Basic_salary = NULLIF(Basic_salary, ''),
    House_allowance = NULLIF(House_allowance, ''),
    Commuter_allowance = NULLIF(Commuter_allowance, ''),
    Extraneous_allowance = NULLIF(Extraneous_allowance, ''),
    Risk_allowance = NULLIF(Risk_allowance, ''),
    Health_worker_allowance = IF(@dummy_variable='', NULL, @dummy_variable),
    Emergency_call_allowance = NULLIF(Emergency_call_allowance, ''),
    Non_practice_allowance = NULLIF(Non_practice_allowance, ''),
    Nursing_service_allowance = NULLIF(Nursing_service_allowance, ''),
    Leave_allowance = NULLIF(Leave_allowance, ''),
    Gross_monthly_pay = NULLIF(Gross_monthly_pay, ''),
    Gratuity = NULLIF(Gratuity, ''),
    Insurance = NULLIF(Insurance, ''),
    Gross_monthly_pay_and_benefits_contract = NULLIF(Gross_monthly_pay_and_benefits_contract, ''),
    Gross_monthly_pay_and_benefits_pnp = NULLIF(Gross_monthly_pay_and_benefits_pnp, ''),
    Gross_annual_pay_and_benefits = NULLIF(Gross_annual_pay_and_benefits, '');

--@block
ALTER TABLE dsppgm_db.KEMRI_pay_structure
MODIFY House_allowance INT NULL,
MODIFY Commuter_allowance INT NULL,
MODIFY Extraneous_allowance INT NULL,
MODIFY Risk_allowance INT NULL,
MODIFY Health_worker_allowance INT NULL,
MODIFY Emergency_call_allowance INT NULL,
MODIFY Non_practice_allowance INT NULL,
MODIFY Nursing_service_allowance INT NULL,
MODIFY Leave_allowance INT NULL,
MODIFY Gratuity INT NULL,
MODIFY Insurance INT NULL;

--@block
ALTER TABLE dsppgm_db.KEMRI_pay_structure CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
--@block
INSERT INTO dsppgm_db.KEMRI_pay_structure (Designation, Job_group_title, Job_group_kmr, Step, Basic_salary, House_allowance ,
    Commuter_allowance , Extraneous_allowance, Risk_allowance, Health_worker_allowance , Emergency_call_allowance, Non_practice_allowance ,
    Nursing_service_allowance, Leave_allowance, Gross_monthly_pay, Gratuity, Insurance, Gross_monthly_pay_and_benefits_contract,
    Gross_monthly_pay_and_benefits_pnp,Gross_annual_pay_and_benefits) 
    VALUES ('Senior Principal Clinical Research Scientist','KMR','KMR 2','Step1',
      325188, 65000, 21000, 40000,20000 )

--@block
Drop TABLE dsppgm_db.KEMRI_pay_structure;

--@block
CREATE TABLE dsppgm_db.Budgets(
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Personnel INT NULL,
    Supplies INT NULL,
    Equipment INT NULL,
    Travel INT NULL,
    Contractual INT NULL,
    Other INT NULL
);

--@block
ALTER TABLE dsppgm_db.Budgets
MODIFY COLUMN Personnel FLOAT,
MODIFY COLUMN Supplies FLOAT,
MODIFY COLUMN Equipment FLOAT,
MODIFY COLUMN Travel FLOAT,
MODIFY COLUMN Contractual FLOAT;

--@block
CREATE TABLE dsppgm_db.equipment(
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Category VARCHAR(255) NULL,
    Sub_category VARCHAR(255) NULL,
    item VARCHAR(255),
    price INT NULL
);
--@block
INSERT INTO dsppgm_db.equipment(Category, Sub_category,price)
VALUES('Stethoscopes','Stethoscopes type a',  20000),
('Stethoscopes','Stethoscopes type b',  30000),
('Stethoscopes','Stethoscopes type c', 40000),
('Stethoscopes','Stethoscopes type d', 50000),
('Sphygmomanometers','Sphygmomanometers type a', 60000),
('Sphygmomanometers','Sphygmomanometers type b', 70000),
('Sphygmomanometers','Sphygmomanometers type c', 80000),
('Sphygmomanometers','Sphygmomanometers type d', 90000),
('Modern sequencing machine','Modern sequencing machine type a', 200000),
('Modern sequencing machine','Modern sequencing machine type b', 300000),
('Modern sequencing machine','Modern sequencing machine type c', 400000),
('Modern sequencing machine','Modern sequencing machine type d', 500000);

--@block
ALTER TABLE dsppgm_db.equipment
ADD Catalogue_No VARCHAR(255) FIRST;

--@block
INSERT INTO dsppgm_db.equipment(Catalogue_No)
VALUES('CAT-000-Stethoscope'),('CAT-000-Stethoscope'), ('CAT-000-Stethoscope'),('CAT-000-Stethoscope');

--@block
ALTER TABLE dsppgm_db.equipment
DROP COLUMN Catalogue_No;

--@block
UPDATE dsppgm_db.equipment
SET Catalogue_No = 
    CASE Category
        WHEN 'Stethoscopes' THEN 'CAT-0000-Stethoscope'
        WHEN 'Sphygmomanometers' THEN 'CAT-1000-Sphygmomanometer'
        WHEN 'Modern sequencing machine' THEN 'CAT-2000-Modern_sequencing_machine'
    END;

--@block
ALTER TABLE dsppgm_db.Budgets 
ADD P_no VARCHAR(255) FIRST;

--@block
DELETE FROM dsppgm_db.Budgets;

--@block
CREATE TABLE dsppgm_db.Supplies(
    Catalogue_No VARCHAR (255),
    Category VARCHAR(255) NULL,
    General_name VARCHAR(255) NULL,
    Model VARCHAR(255) NULL,
    item VARCHAR(255) NULL,
    price INT NULL
);

--@block
INSERT INTO dsppgm_db.Supplies(Catalogue_No,Category, General_name, Model, item, price )
VALUES('T-P-000', 'Lab', 'Test tube', 'Plastic Test tube A', 'Plastic Test tube',200), 
('T-P-000', 'Lab', 'Test tube', 'Plastic Test tube B', 'Plastic Test tube',200),
('P-M-000', 'Office', 'Printer', 'HP printer', 'Monochrome printer',200000),
('P-M-000', 'office', 'Printer', 'Dell printer', 'Monochrome printer',70000),
('P-C-111', 'Office', 'Toner', 'Colored Toner', 'Colored Toner',200000),
('P-C-111', 'office', 'Printer', 'Monochrome Toner A', 'Colored Toner',70000),
('T-M-111', 'Lab', 'Test tube', 'Metallic Test tube A ', 'Metallic Test tube',2500),
('T-M-111', 'Lab', 'Test tube', 'Metallic Test tube B', 'Metallic Test tube',1200);
--@block
CREATE TABLE dsppgm_db.Per_diems_local_travel(
    KMR VARCHAR (255),
    Per_diem_rate INT
);

--@block
DROP TABLE dsppgm_db.Per_diems_local_travel;

--@block
CREATE TABLE dsppgm_db.Per_diems_foreign_travel(
    AREA VARCHAR (255),
    Per_diem_rate INT
);

--@block
INSERT INTO dsppgm_db.Per_diems_foreign_travel(AREA, Per_diem_rate)
VALUES ('Africa', 20000),('North America', 30000),('South America',40000),('Asia', 50000),('EUROPE',60000);

--@block
CREATE TABLE dsppgm_db.Contractuals(
    Contractual_type VARCHAR (255),
    Cost INT
);

--@block
INSERT INTO dsppgm_db.Contractuals(Contractual_type, Cost)
VALUES ('Office machine servicing', 20000),('Lab machine servicing', 30000),('Sample storage',40000),('Subscription', 50000);

--@block
RENAME TABLE dsppgm_db.Contractuals TO dsppgm_db.Others;

--@block
INSERT INTO dsppgm_db.Contractuals(Contractual_type, Cost)
VALUES ('IRB', 15000);

--@block
DELETE FROM dsppgm_db.others WHERE Contractual_type = 'IRB';

--@block
CREATE TABLE dsppgm_db.Per_diems_international_travel(
    NUM INT,
    COUNTRY VARCHAR(255) NULL,
    NOT_APPLICABLE VARCHAR(255) NULL,
    KMR1 INT NULL,
    KMR2 INT NULL,
    KMR3 INT NULL,
    KMR4 INT NULL,
    KMR5 INT NULL,
    KMR6 INT NULL,
    KMR7 INT NULL,
    KMR8 INT NULL,
    KMR9 INT NULL,
    KMR10 INT NULL,
    KMR11 INT NULL,
    KMR12 INT NULL 
);

--@block
DROP TABLE dsppgm_db.Per_diems_international_travel;

--@block
UPDATE dsppgm_db.supplies SET Item = 'DELL colored printer' WHERE Model = 'DELL printer';
