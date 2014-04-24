<?php

/*****************************************
*	Insert Queries for Inventory Database  *
*****************************************/









/*****************************************
*	Select Queries for Inventory Database  *
*****************************************/

// Retrieve all non-lab computers
/*$get_all_computers = "	SELECT		e.tag_num,
									e.serial,
									CONCAT( e.make, ' ', e.model ),
									c.os,
									c.hostname,
									e.department,
									e.location,
									CONCAT( e.building, ' ', e.room_num ), 	
									p.purchase_order,
									p.purchase_date,
									p.purchased_by,
									n.mac,
									n.wmac,
									n.ip

						FROM 		equipment e,
									computer c,
									eq_network n,
									purchase p, 
									user u,
									uses us

						WHERE	 	c.computer_tag = e.tag_num AND
									us.tag_num = e.tag_num AND
									us.user_id = u.user_id AND 
									e.purchase_id = p.purchase_id AND
									n.tag_num = e.tag_num AND
									u.l_name IS NOT NULL

						GROUP BY 	e.tag_num

						ORDER BY 	e.tag_num DESC";
*/
$get_all_computers = "	SELECT		e.tag_num,
									e.serial,
									CONCAT( e.make, ' ', e.model ),
									e.department,
									e.location,
									CONCAT( e.building, ' ', e.room_num ) 	

						FROM 		equipment e,
									computer c,
									user u,
									uses us

						WHERE	 	c.computer_tag = e.tag_num AND
									us.tag_num = e.tag_num AND
									us.user_id = u.user_id AND 
									u.l_name IS NOT NULL

						GROUP BY 	e.tag_num

						ORDER BY 	e.tag_num DESC";



// Retrieve all lab computers 
$get_all_labs = "SELECT		e.tag_num,
													e.serial,
													CONCAT( e.make, ' ', e.model ),
													c.os,
											 		c.hostname,
													e.department,
													CONCAT( e.building, ' ', e.room_num ), 	
											 		p.purchase_order,
													p.purchase_date,
													p.purchased_by,
													n.mac,
													n.wmac,
													n.ip

								FROM 			equipment e,
													computer c,
													eq_network n,
													purchase p, 
													user u,
													uses us

								WHERE 		c.computer_tag = e.tag_num AND
													us.tag_num = e.tag_num AND
													us.user_id = u.user_id AND 
													e.purchase_id = p.purchase_id AND
													n.tag_num = e.tag_num AND
													u.l_name IS NULL

								GROUP BY 	e.tag_num

								ORDER BY 	e.tag_num ASC";


// Retrieve all network printers
$get_all_network_printers = "SELECT		e.tag_num,
																			e.serial,
																			CONCAT( e.make, ' ', e.model ),
																	 		pr.hostname,
																			e.department,
																			CONCAT( e.building, ' ', e.room_num ), 	
																	 		p.purchase_order,
																			p.purchase_date,
																			p.purchased_by,
																			n.mac,
																			n.wmac,
																			n.ip

														FROM 			equipment e,
																			eq_network n,
																			purchase p,
																			network_printer pr

														WHERE 		pr.printer_tag = e.tag_num AND
																			e.purchase_id = p.purchase_id AND
																			n.tag_num = e.tag_num

														ORDER BY 	pr.hostname ASC";


// Retrieve all purchase orders
$get_all_purchase_orders = "SELECT	 	p.purchase_id,
																			p.purchase_order,
																			p.purchase_date,
																			p.purchased_by

														FROM			purchase p

														WHERE			p.purchase_order IS NOT NULL

														ORDER BY	p.purchase_date DESC";


// Retrieve all licensed software
$get_all_software = "SELECT s.software_id,
														s.software_name,
														s.license_num,
														s.license_type,
														s.number_of_licenses,
														s.notes

										FROM		software s";


// Retrieve all faculty/staff users
$get_all_users = "SELECT		u.user_id, 
														u.f_name, 
														u.l_name

									FROM			user u

									WHERE			u.l_name IS NOT NULL

									ORDER BY	u.l_name ASC";

// Retrieve all computers based on licensed software
$get_computers_from_software_id = "SELECT	e.tag_num,
																					e.serial,
																					CONCAT( e.make, ' ', e.model ),
																					e.location,
																					CONCAT( e.building, ' ', e.room_num ),
																					e.department

																	FROM		equipment e,
																					computer c,
																					licensed_to l

																	WHERE		e.tag_num = c.computer_tag AND
																					c.computer_tag = l.computer_tag AND
																					l.software_id = ?";


// Retrieve all equipment based on purchase order
$get_equipment_from_user = "SELECT 	e.tag_num,
																		e.serial,
																		CONCAT( e.make, ' ', e.model ),
																		e.location,
																		CONCAT( e.building, ' ', e.room_num ),
																		e.department

														FROM		equipment e,
																		purchase p

														WHERE		e.purchase_id = p.purchase_id AND
																		p.purchase_id = ?";


// Retrieve all equipment based on user ID
$get_equipment_from_user = "SELECT 	e.tag_num,
																		e.serial,
																		CONCAT( e.make, ' ', e.model ),
																		e.location,
																		CONCAT( e.building, ' ', e.room_num ),
																		e.department

														FROM		equipment e,
																		uses us

														WHERE		e.tag_num = us.tag_num AND
																		us.user_id = ?";


// Retrieve notes based on tag number
$get_notes_from_tag = "SELECT n.notes

											 FROM 	eq_notes n

											 WHERE 	n.tag_num = ?";


// Retrieve printer based on tag number
$get_printer_from_tag = "SELECT p.printer

								 				 FROM 	eq_printer p

												 WHERE 	p.tag_num = ?";


// Retrieve all software based on tag number
$get_software_from_tag = "SELECT 	s.software_name,
																	s.license_type

													FROM 		software s,
																	licensed_to l

													WHERE 	s.software_id = l.software_id AND
																	l.computer_tag = ?";


// Retrieve all users based on tag number
$get_users_from_tag = "SELECT u.f_name,
															u.l_name

											 FROM 	user u,
															uses us
						
								  		 WHERE 	u.user_id = us.user_id AND
															us.tag_num = ?";







?>
