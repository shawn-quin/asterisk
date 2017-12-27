 <?php
 
//Some housekeeping variables: Asterisk confbridge commands
 
$listCommand = "confbridge list ";
$confRoom = "1 ";
$all = "all";
$kickCommand = "confbridge kick ";
$muteCommand = "confbridge mute ";
$unmuteCommand = "confbridge unmute ";

//Disconnect all participants

exec('asterisk -rx '.escapeshellarg($kickCommand).''.escapeshellarg($confRoom).''.escapeshellarg($all).'',$out);

//Mute all participants

exec('asterisk -rx '.escapeshellarg($muteCommand).''.escapeshellarg($confRoom).''.escapeshellarg($all).'',$out);

//UnMute all participants

exec('asterisk -rx '.escapeshellarg($unmuteCommand).''.escapeshellarg($confRoom).''.escapeshellarg($all).'',$out);

//Mute Specific Participant, [2] will always be the admin
//First Command lists a particular available conference
 
exec('asterisk -rx '.escapeshellarg($listCommand).''.escapeshellarg($confRoom).'',$out);

//phone number to check

$phone = "07XXXXXXXX";

//Set you if-else conditions here

$def=1;

//get array length

$out_length=count($out);
$default_out=0;

while ($default_out<$out_length)
	{

        $new_out=$out[$default_out];
        $explode_out=explode(' ',$new_out);
				
        if (in_array($phone,$explode_out))
			{
                if($def == '1')
					{
						echo "\n"."Member found, kicking out..."."\n";
						exec('asterisk -rx '.escapeshellarg($kickCommand).''.escapeshellarg($confRoom).''.escapeshellarg($explode_out[0]).'',$out);
						echo "Member ".$explode_out[31]." has been kicked out of this conference"."\n"."\n";
					}
				
				else if ($def == '2')
					{
						echo "\n"."Member found, muting..."."\n";
						exec('asterisk -rx '.escapeshellarg($muteCommand).''.escapeshellarg($confRoom).''.escapeshellarg($explode_out[0]).'',$out);
						echo "Member ".$explode_out[31]." has been muted in this conference"."\n"."\n";
					}
					
				else if ($def == '3')
					{
						echo "\n"."Member found, unmuting..."."\n";
						exec('asterisk -rx '.escapeshellarg($unmuteCommand).''.escapeshellarg($confRoom).''.escapeshellarg($explode_out[0]).'',$out);
						echo "Member ".$explode_out[31]." has been muted in this conference"."\n"."\n";
					}
						
				else
					{
						echo "No action available."."\n";
					}		
			}
		else
					{
						echo "Member not in Conference"."\n";
					}
        $default_out=$default_out+1;
	}
 
 ?>
