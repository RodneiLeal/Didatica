<?php
	include '_db.php';
	include '_funcoes.php';
	
	setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');

	$data_cadastro = date("Y-m-d H:i:s");

	class crud{
		private $sql_ins="";
		private $table="";
		private $sql_sel="";

		public function __construct($table)
		{
			$this->table = $table;
			return $this->table;
		}
		
			/** 
				INSERT
				EX: $fields = "id, name, email", "1, 'Jhon Doe', 'email@server.com'"
			*/         
			public function insert($mysqli, $fields, $value)
			{
				//echo "INSERT INTO " . $this->table . " ($fields) VALUES ($value)";

				$this->sql_ins = "INSERT INTO " . $this->table . " ($fields) VALUES ($value)";
				return !mysqli_query($mysqli, $this->sql_ins);

				// if(!mysqli_query($mysqli, $this->sql_ins))
				// {
				// 	return 0;
				// }
				// else
				// {
				// 	return 1;
				// }
			}

		
				/** 
					UPDATE
					EX: $fieldsWITHvalue = "name='Jhon Doe', email='email@server.com'", " id=1 "
				*/  
				public function update($mysqli, $fieldsWITHvalue, $where = NULL)
				{
					//echo "UPDATE  " . $this->table . " SET $fieldsWITHvalue WHERE $where";
					if ($where)
					{
						$this->sql_upd = "UPDATE  " . $this->table . " SET $fieldsWITHvalue WHERE $where";           
					}
					else
					{
						$this->sql_upd = "UPDATE  " . $this->table . " SET $fieldsWITHvalue";
					}
					
					if(!$this->upd = mysqli_query($mysqli, $this->sql_upd))
					{
						return 0;
							
					}else{
						return 1;
					}
				}



				

						/** 
							DELETE
							EX: $fieldsWITHvalue = "id=1"
						*/        
						public function remove($mysqli, $where = NULL) // funçao de exclusao, campo que define a linha a ser editada como parametro
						{
							//echo "SELECT * FROM " . $this->table . " WHERE $where";
							if ($where)
							{
								$this->sql_sel = "SELECT * FROM " . $this->table . " WHERE $where";
								$this->sql_del = "DELETE FROM " . $this->table . " WHERE $where";
							}else
							{
								$this->sql_sel = "SELECT * FROM " . $this->table;
								$this->sql_del = "DELETE FROM " . $this->table;
							}
							$sel=mysqli_query($mysqli, $this->sql_sel);
							$regs=mysqli_num_rows($sel);
						
								if ($regs > 0)
								{
									if(!$this->del = mysqli_query($mysqli, $this->sql_del))
									{
										return 0;
									}else{
										return 1;
									}
								}

						}     
	}         

	function Table($rs, $headers, $buttons)	{
		
		$num_fields = mysql_num_fields($rs);
			
		for($i = 0;$i<$num_fields; $i++){ //CAPTURE NAME OF FIELDS
			$fields[] = mysql_field_name($rs,$i);
		}

				$table = '<table class="table table-togglable table-xs table-hover"><tr>';
				foreach ($headers as $header)
				{
					$table .=  "<td>$header</td>";
				}
				
				//TABLE AMOUNT
				$table .= '<tbody>';
				while($r = mysql_fetch_array($rs)){
					$table .= '<tr>';
				
					$register_id = 0;
					for($i = 0;$i < $num_fields; $i++){
						$table .= '<td>'.$r[$fields[$i]].'</td>';
						
						if($register_id == 0)
						{
							$buttons_reg = str_replace("register_id",$r[$fields[$i]] ,$buttons);
						}
						$register_id = 1;
					}
					
					$table .= '
						<td >
							'.$buttons_reg.'
						</td>';
											
					$table .= '</tr>';
				}
					
				$table .= '</tbody></table>';
							
				echo $table;
	}
	
	
	
	
	
	 
?>	