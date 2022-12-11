function activeS(ID,TP){
	$(".playerList .text").fadeOut().empty().html("ESCOLHA UM <b>EPISÓDIO</b>").css("margin-top", "100px").fadeIn(); 
	$(".inf_spost").css('display','none'); 
	$(".noload").css('display','none'); 
	$(".megabox").css('display','none'); 
	$(".ac_"+ID+"_"+TP).removeAttr('style'); 
	$(".noaudi").removeAttr('style'); 
} 

function activeT(TP,ID){
	$(".playerList .text").fadeOut().empty().html("ESCOLHA UM <b>PLAYER</b>").css("margin-top", "50px").fadeIn(); 
	$(".megabox").css('display','none'); 
	$("#"+TP+ID).removeAttr('style'); 
}