<?php
use lithium\data\Connections;

 Connections::add('default', array(
 	'type' => CONNECTION_TYPE,
 	'host' => array(CONNECTION,
		),
//	'replicaSet' => true,
 'database' => CONNECTION_DB,
	'login' => CONNECTION_USER,
	'password' => CONNECTION_PASS,	
//	'setSlaveOkay' => true,
//	'readPreference' => Mongo::RP_NEAREST	
 ));

 Connections::add('SiiCrypto', array(
 	'type' => CONNECTIONSII_TYPE,
 	'host' => array(CONNECTIONSII,
		),
//	'replicaSet' => true,
 'database' => CONNECTIONSII_DB,
	'login' => CONNECTIONSII_USER,
	'password' => CONNECTIONSII_PASS,	
//	'setSlaveOkay' => true,
//	'readPreference' => Mongo::RP_NEAREST	
 ));
?>