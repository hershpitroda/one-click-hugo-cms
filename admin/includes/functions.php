<?php
/* CLEAN INPUT  */
function clean_var($variable) {
    $variable = strip_tags(stripslashes(trim(rtrim($variable))));
  return $variable;
}

/* VALID NAME  */
function validName( $name ){
	if( empty( $name ) ){
		return 1;
	}else{
		if( !preg_match("/^[a-zA-Z0-9-,\s]+$/i", $name) ){
			return 1;
		}else{
			return 0;
		}
	}
}

/* VALID NUMBER  */
function validNumber( $number ){
	if( empty( $number ) ){
		return 1;
	}else{
		if( !preg_match("/^[a-zA-Z0-9-,\s]+$/i", $number) ){
			return 1;
		}else{
			return 0;
		}
	}
}

/* VALID MESSAGE  */
function validMessage( $name ){
	if( empty( $name ) ){
		return 1;
	}else{
		if( !preg_match("/^[a-zA-Z0-9-,.\/!#$^&'*\s]+$/i", $name) ){
			return 1;
		}else{
			return 0;
		}
	}
}

/* VALID ALPHANUMERICS  */
function validAlphanum( $alphanum, $type ){
	if( empty( $alphanum ) ){
		return 1;
	}else{
		if( $type == "password" ){
			if( !preg_match("/^[a-zA-Z0-9!@#$^&*]{6,}$/", $alphanum) ){
				return 1;
			}else{
				return 0;
			}
		}
		
		if( $type == "address" ){
			if( !preg_match("/^[a-zA-Z0-9!@#$^&*\s]+$/i", $alphanum) ){
				return 1;
			}else{
				return 0;
			}
		}
	}
}

/* VALID PHONE NUMBERS  */
function validPhone( $phone ){
	if( empty( $phone ) ){
		return 1;
	}else{
		if( !preg_match("/^[0-9]{3}[0-9]{3}[0-9]{4}$/i", $phone) ){
			return 1;
		}else{
			return 0;
		}
	}
}

/* VALID DATE  */
function validDate( $day, $month, $year ){
	if( ($day == 0) || ($month == 0) || ($year == 0) ){
		return 1;
	}else{
		switch( $month ){
			case 2: if( ( $year%4 != 0) || ( $year%400 != 0 ) || ( $year%100 != 0 ) ){
						if( $day > 28 ){
							return 1;
						}else{
							return 0;
						}
					}else{
						if( $day > 29 ){
							return 1;
						}else{
							return 0;
						}
					}
				    break;
		
		}
	}
}

/* VALID EMAILS  */
function validEmail( $email ){
	if( empty( $email ) ){
		return 1;
	}else{
		if( !preg_match("/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i", $email) ){
			return 1;
		}else{
			return 0;
		}
	}
}
?>