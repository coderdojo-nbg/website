#
# Table structure for table 'tx_twcoderdojo_domain_model_person'
#
CREATE TABLE tx_twcoderdojo_domain_model_person (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	type int(11) DEFAULT '0' NOT NULL,
	gender int(11) DEFAULT '0' NOT NULL,
	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	birthday date DEFAULT '0000-00-00',
	portrait int(11) unsigned NOT NULL default '0',
	biography text NOT NULL,
	statement text NOT NULL,
	anonymous tinyint(1) unsigned DEFAULT '0' NOT NULL,
	contacts int(11) unsigned DEFAULT '0' NOT NULL,
	skills int(11) unsigned DEFAULT '0' NOT NULL,
	guardian int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_twcoderdojo_domain_model_contact'
#
CREATE TABLE tx_twcoderdojo_domain_model_contact (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	person int(11) unsigned DEFAULT '0' NOT NULL,

	type int(11) DEFAULT '0' NOT NULL,
	value varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_twcoderdojo_domain_model_skill'
#
CREATE TABLE tx_twcoderdojo_domain_model_skill (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_twcoderdojo_domain_model_date'
#
CREATE TABLE tx_twcoderdojo_domain_model_date (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	dojo_number int(11) unsigned DEFAULT '0',
	start datetime DEFAULT '0000-00-00 00:00:00',
	end datetime DEFAULT '0000-00-00 00:00:00',
	intro text NOT NULL,
	location int(11) unsigned DEFAULT '0',
	mentors int(11) unsigned DEFAULT '0' NOT NULL,
	ninjas int(11) unsigned DEFAULT '0' NOT NULL,
	helpers int(11) unsigned DEFAULT '0' NOT NULL,
	capacity int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_twcoderdojo_domain_model_location'
#
CREATE TABLE tx_twcoderdojo_domain_model_location (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	street_address varchar(255) DEFAULT '' NOT NULL,
	postal_code varchar(255) DEFAULT '' NOT NULL,
	locality varchar(255) DEFAULT '' NOT NULL,
	latitude varchar(255) DEFAULT '' NOT NULL,
	longitude varchar(255) DEFAULT '' NOT NULL,
	googlemaps varchar(255) DEFAULT '' NOT NULL,
	country int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_twcoderdojo_domain_model_contact'
#
CREATE TABLE tx_twcoderdojo_domain_model_contact (

	person  int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_twcoderdojo_person_skill_mm'
#
CREATE TABLE tx_twcoderdojo_person_skill_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_twcoderdojo_date_mentor_mm'
#
CREATE TABLE tx_twcoderdojo_date_mentor_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_twcoderdojo_date_ninja_mm'
#
CREATE TABLE tx_twcoderdojo_date_ninja_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_twcoderdojo_date_helper_mm'
#
CREATE TABLE tx_twcoderdojo_date_helper_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
