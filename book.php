<?
$fromDateArray = explode("/",$_GET['check_in_date']);
$toDateArray = explode("/",$_GET['check_out_date']);
$redirectURL = "https://www.thebookingbutton.co.uk/reservations/idlerocksdirect/".$_GET['id']."/?check_in_date=".$fromDateArray[2]."-".$fromDateArray[1]."-".$fromDateArray[0]."&check_out_date=".$toDateArray[2]."-".$toDateArray[1]."-".$toDateArray[0];
?>
<script>location.href='<?=$redirectURL;?>'</script>  