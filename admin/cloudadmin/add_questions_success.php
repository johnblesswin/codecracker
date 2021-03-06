<?php

	require 'sess.php';
	require 'securequestion.php';

	if(empty($_POST))
	{
		header('Location:add_questions.php');
		die();
	}
	else
	{
		try
		{
			if($_POST['type']==="mcq")
			{



				$question	= htmlentities($_POST['question']);
				$option1	= htmlentities($_POST['option1']);
				$option2	= htmlentities($_POST['option2']);
				$option3	= htmlentities($_POST['option3']);
				$option4	= htmlentities($_POST['option4']);
				$category	= htmlentities($_POST['category']);
				$type		= htmlentities($_POST['type']);
				$answer     = htmlentities($_POST['answer']);
				
				
				
				if(strlen($question)==0){
					echo "Question is empty";
					die();
				}else if(strlen($option1)==0){
					echo "Option 1 is empty";
					die();
				}else if(strlen($option2)==0){
					echo "Option 2 is empty";
				}else if(strlen($option3)==0){
					echo "Option 3 is empty";
					die();
				}else if(strlen($option4)==0){
					echo "Option 4 is empty";
					die();
				}else if(strlen($answer)==0){
					echo "Answer is empty";
					die();
				}else if(ctype_digit($answer)==false)
				{
					echo "ANSWER SHOULD BE NUMBER BETWEEN 1-4";
					die();
				}
				elseif($answer > 4)
				{
					echo "ANSWER SHOULD BE NUMBER BETWEEN 1-4";
					die();
				}
				else
				{
					$answer= intval($answer);
					$secured_answer=password_hash($answer,PASSWORD_DEFAULT);

					
					$addquestioncollection= $db->selectCollection('questions');			
					$countquestion= $addquestioncollection->find(array("category" =>$category, 
						"type" => $type))->count();					
		
					$data=array();
					$data['questionnumber']	= 	$countquestion;
					$data['category']		=	$category;
					$data['type']			=	$type;
					$data['text'] 			=	$question;
					$data['option1']		= 	$option1;
					$data['option2']		= 	$option2;
					$data['option3']		= 	$option3;
					$data['option4']		= 	$option4;
					$data['answer'] 		= 	$secured_answer;
					$addquestioncollection->insert($data);
					echo "success";
					
					die();
				}
			}
			else if($_POST['type']==="coding")
			{

				$question	= secure1($_POST['question']);		

				$input		= $_POST['input'];
				$output     = $_POST['output'];
				
				$input_array = explode(",",$input);
				$input_array_json = json_encode($input_array);

				$output_array = explode(",",$output);
				$output_array_json = json_encode($output_array);
				

				$category	= secure1($_POST['category']);	
				$type		= secure1($_POST['type']);	

				if(strlen($question)==0){
					echo "Question is empty";
					die();
				}else if(strlen($input)==0){
					echo "Input is empty";
					die();
				}else if(strlen($output)==0){
					echo "Output is empty";
					die();
				}else{

					$addquestioncollection= $db->selectCollection('questions');			
					$countquestion= $addquestioncollection->find(array("category" =>$category, 
						"type" => $type))->count();					
		
					$data=array();
					$data['questionnumber']	= 	$countquestion;
					$data['category']		=	$category;
					$data['type']			=	$type;
					$data['text'] 			=	$question;
					$data['input']			= 	$input_array_json;
					$data['output']			= 	$output_array_json;
					$addquestioncollection->insert($data);
					echo "success";
					die();


				}




			}else
			{
				die("SOMETHING WENT WRONG");
			}



		}
		catch(MongoException $e)
		{
			echo "Exception Occured";
			die();
		}


	}
		

	
	
	

?>







