
UPDATE tconfig SET value = '1.3' WHERE token = 'db_scheme_version';
UPDATE tconfig SET value = '1.3' WHERE token = 'db_scheme_build';
INSERT INTO tconfig (token, value) VALUES ('show_unknown','0');
INSERT INTO tconfig (token, value) VALUES ('show_lastalerts','1');
INSERT INTO tconfig (token, value) VALUES ('style','pandora');


UPDATE tconfig_os SET icon_name = 'so_aix.png' WHERE icon_name = 'so_aix.gif';
UPDATE tconfig_os SET icon_name = 'so_linux.png' WHERE icon_name = 'so_linux.gif';
UPDATE tconfig_os SET icon_name = 'so_solaris.png' WHERE icon_name = 'so_solaris.gif';
UPDATE tconfig_os SET icon_name = 'so_hpux.png' WHERE icon_name = 'so_hpux.gif';
UPDATE tconfig_os SET icon_name = 'so_beos.png' WHERE icon_name = 'so_beos.gif';
UPDATE tconfig_os SET icon_name = 'so_cisco.png' WHERE icon_name = 'so_cisco.gif';
UPDATE tconfig_os SET icon_name = 'so_mac.png' WHERE icon_name = 'so_mac.gif';
UPDATE tconfig_os SET icon_name = 'so_win.png' WHERE icon_name = 'so_win.gif';
UPDATE tconfig_os SET icon_name = 'so_other.png' WHERE icon_name = 'so_other.gif';
UPDATE tconfig_os SET icon_name = 'network.png' WHERE icon_name = 'network.gif';

UPDATE tgrupo SET icon = 'world', parent = 0, disabled = 0 WHERE id_grupo = 1;
UPDATE tgrupo SET icon = 'server_database', parent = 0, disabled = 0 WHERE id_grupo = 2;
UPDATE tgrupo SET icon = 'eye', parent = 0, disabled = 0 WHERE id_grupo = 3;
UPDATE tgrupo SET icon = 'firewall', parent = 0, disabled = 0 WHERE id_grupo = 4;
UPDATE tgrupo SET icon = 'database_gear', parent = 0, disabled = 0 WHERE id_grupo = 8;
UPDATE tgrupo SET icon = 'transmit', parent = 0, disabled = 0 WHERE id_grupo = 9;
UPDATE tgrupo SET icon = 'house', parent = 0, disabled = 0 WHERE id_grupo = 10;
UPDATE tgrupo SET icon = 'computer', parent = 0, disabled = 0 WHERE id_grupo = 11;
UPDATE tgrupo SET icon = 'applications', parent = 0, disabled = 0 WHERE id_grupo = 12;

INSERT INTO `tnetwork_component` VALUES (1,'OS Total process','Total process in Operating System (UNIX MIB)',5,8,0,0,0,0,'','NULL','NULL','',0),(2,'OS CPU Load','CPU Load in Operating System (UNIX MIB)',5,9,0,0,0,0,'','NULL','NULL','',0),(3,'Sysname','Get name of system using SNMP standard MIB',1,17,0,0,900,0,'','','public','.1.3.6.1.2.1.1.1.0',1),(4,'OS Users','Active users in Operating System (UNIX MIB)',5,6,0,0,0,0,'','NULL','NULL','',0),(5,'CiscoAP Wifi traffic','Cisco AP AP120',9,6,0,0,0,0,'','NULL','NULL','',0),(6,'CiscoAP Wifi errors','Get errors con WiFi for Cisco AP AP120',9,16,0,0,300,0,'','','public','',2),(7,'CiscoAP RAM','Get RAM available on device',9,15,0,0,300,0,'','','public','',4),(8,'CiscoAP Ethernet OUT','Cisco AP AP120',9,6,0,0,0,0,'','NULL','NULL','',0),(9,'CiscoAP Ethernet IN','Cisco AP AP120',9,6,0,0,0,0,'','NULL','NULL','',0),(10,'CiscoAP CPU Usage','Cisco AP AP120',9,6,0,0,0,0,'','NULL','NULL','',0),(11,'Cisco Catalyst CPU Usage','Cisco Catalyst 3750',8,6,0,0,0,0,'','NULL','NULL','',0),(12,'FlashFree ','Cisco Catalyst 3750',8,6,0,0,0,0,'','NULL','NULL','',0),(13,'RAM_Usage','Cisco Catalyst 3750',8,6,0,0,0,0,'','NULL','NULL','',0),(16,'CPU Usage','',7,6,0,0,0,0,'','NULL','NULL','',0),(17,'Memory available','',7,6,0,0,0,0,'','NULL','NULL','',0),(18,'Configuration changes','',7,6,0,0,0,0,'','NULL','NULL','',0),(19,'Power #1','',6,18,0,0,180,0,'','','public',' .1.3.6.1.4.1.2334.2.1.5.8.0',4),(20,'Power #2','',6,18,0,0,180,0,'','','public',' .1.3.6.1.4.1.2334.2.1.5.10.0',4),(21,'User concurrence','',6,6,0,0,0,0,'','NULL','NULL','',0),(22,'HSRP Status','Get status of HSRP',2,18,0,0,180,0,'','','public','1.3.6.1.4.1.9.9.106.1.2.1.1.15.12.106',2),(23,'Num. of classes','',6,6,0,0,0,0,'','NULL','NULL','',0),(24,'NIC #1 status','Status of NIC#1',10,18,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.8.1',2),(25,'NIC #2 status','Status of NIC #2',10,18,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.8.2',2),(26,'NIC #3 status','Status of NIC #3',10,18,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.8.3',2),(27,'NIC #1 outOctects','Output throughtput on Interface #1',10,16,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.16.1',2),(28,'NIC #2 outOctects','Output troughtput on interface #2',10,16,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.16.2',1),(29,'NIC #3 outOctects','Output troughtput on Interface #3',10,16,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.16.3',2),(30,'NIC #1 inOctects','Input troughtput on Interface #1',10,16,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.10.1',2),(31,'NIC #2 inOctects','Input throughtput for interface #2',10,16,0,0,180,0,'','NULL','public','.1.3.6.1.2.1.2.2.1.10.2',2),(32,'NIC #3 inOctects','Input throught on interface #3',10,16,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.10.3',2),(34,'Host Alive','Check if host is alive using ICMP ping check.',10,6,0,0,120,0,'','','','',2),(36,'Host Latency','Get host network latency in miliseconds, using ICMP.',10,7,0,0,180,0,'','','','',2),(37,'Check HTTP Server','Test APACHE2 HTTP service remotely (Protocol response, not only openport)',10,9,0,0,300,80,'GET / HTTP/1.0^M^M','HTTP/1.1 200 OK','','',3),(38,'Check FTP Server','Check FTP protocol, not only check port.',10,9,0,0,300,21,'QUIT','221','','',3),(39,'Check SSH Server','Checks port 22 is opened',10,9,0,0,300,22,'','','','',2),(40,'Check Telnet server','Check telnet port',10,9,0,0,300,23,'','','','',2),(41,'Check SMTP server','Check if SMTP port it&#039;s open',10,9,0,0,300,25,'','','','',2),(42,'Check POP3 server','Check POP3 port.',10,9,0,0,300,110,'','','','',2),(43,'NIC #7 outOctects','Get outcoming octects from NIC #7',10,16,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.16.7',2),(44,'NIC #7 inOctects','Get incoming octects from NIC #7',10,16,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.10.7',2),(45,'NIC #4 Status','Get status of NIC #4',10,18,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.8.4',2),(46,'NIC #5 Status','Get status of NIC #5',10,18,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.8.5',2),(47,'NIC #6 Status','Get status of NIC #6',10,18,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.8.6',2),(48,'NIC #7 Status','Get status of NIC #7',10,18,0,0,180,0,'','','public','.1.3.6.1.2.1.2.2.1.8.7',2);


INSERT INTO `tnetwork_component_group` VALUES (1,'General group',0),(2,'Cisco MIBs',10),(3,'Nortel MIBS',10),(4,'3COM MIBs',10),(5,'UNIX MIBs',12),(6,'Packetshaper MIBs',10),(7,'Nortel BPS 2000 MIBs',3),(8,'Cisco Catalyst3750 MIBs',2),(9,'Cisco AP120+',2),(10,'Network Management',0),(11,'Microsoft Windows MIB',12),(12,'Operating Systems',0);

UPDATE ttipo_modulo SET icon = 'mod_data.png' WHERE icon = 'mod_data.gif';
UPDATE ttipo_modulo SET icon = 'mod_proc.png' WHERE icon = 'mod_proc.gif';
UPDATE ttipo_modulo SET icon = 'mod_string.png' WHERE icon = 'mod_string.gif';
UPDATE ttipo_modulo SET icon = 'mod_data_inc.png' WHERE icon = 'mod_data_inc.gif';
UPDATE ttipo_modulo SET icon = 'mod_icmp_proc.png' WHERE icon = 'mod_icmp_proc.gif';
UPDATE ttipo_modulo SET icon = 'mod_icmp_data.png' WHERE icon = 'mod_icmp_data.gif';
UPDATE ttipo_modulo SET icon = 'mod_tcp_data.png' WHERE icon = 'mod_tcp_data.gif';
UPDATE ttipo_modulo SET icon = 'mod_tcp_proc.png' WHERE icon = 'mod_tcp_proc.gif';
UPDATE ttipo_modulo SET icon = 'mod_tcp_string.png' WHERE icon = 'mod_tcp_string.gif';
UPDATE ttipo_modulo SET icon = 'mod_tcp_inc.png' WHERE icon = 'mod_tcp_inc.gif';
UPDATE ttipo_modulo SET icon = 'mod_udp_proc.png' WHERE icon = 'mod_udp_proc.gif';
UPDATE ttipo_modulo SET icon = 'mod_snmp_data.png' WHERE icon = 'mod_snmp_data.gif';
UPDATE ttipo_modulo SET icon = 'mod_snmp_inc.png' WHERE icon = 'mod_snmp_inc.gif';
UPDATE ttipo_modulo SET icon = 'mod_snmp_string.png' WHERE icon = 'mod_snmp_string.gif';
UPDATE ttipo_modulo SET icon = 'mod_snmp_proc.png' WHERE icon = 'mod_snmp_proc.gif';

INSERT INTO `tnews` VALUES (1,'admin','Welcome to Pandora FMS 1.3 !','This is our new console, a lot of new features has been added from last version. Please read documentation about it and be free to test any option.\r\n\r\nPandora FMS team.','2007-06-22 13:03:20');
