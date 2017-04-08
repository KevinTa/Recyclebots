var ind;
var score=0;
var end = false;
var started = false;
var asked = 0;
var Timer; 
var TotalSeconds;
var widthval;
function CreateTimer() { 
document.getElementById("bar").style.visibility="visible";
Timer = document.getElementById("time"); 
TotalSeconds = 15; 
UpdateTimer() 
window.setTimeout("Tick()", 1000); }
function Tick() { if (TotalSeconds <= 0 && end==false) { 
	clearAnswers();
	Tquestions.splice(ind,1);
	Tanswers.splice(ind,1);
	showQuestion();
	showAnswers();
	TotalSeconds=15;
	if(Tquestions.length==1)
		{
			end = true;
		}
	} 	
	if(TotalSeconds<=0 && end==true){
	document.getElementById("message").innerHTML="Quiz Finished!";
	document.getElementById("bar").style.visibility="hidden";
	document.getElementById("exit").style.display="none";
	document.getElementById("timedis").style.display= "none";
	document.getElementById("question").innerHTML="";
	clearAnswers();
	document.getElementById("submit").removeChild(document.getElementById("check"));
	return;
	}
	if(started==false)
	{
	return;
	}
	TotalSeconds -= 1; 
	widthval = (TotalSeconds/15) * 100;
	document.getElementById("bar").style.width=widthval+"px";
	UpdateTimer();
	window.setTimeout("Tick()", 1000); 
	}
function UpdateTimer() { Timer.innerHTML = TotalSeconds; }
var questions = 
		[
			{question: "At least how long will it take a glass bottle to decompose?", answer: "4000 years" },
			{question: "On average, how much paper is used each year by an American?", answer: "680 lb" },
			{question: "About how much less air pollution does recycle paper produce compared to raw paper?", answer: "70%" },
			{question: "How many acres of rainforest are cut down per minute?", answer: "100"},
			{question: "Which unrecycled material causes the most harm to ocean animals?", answer: "plastic"},
			{question: "What percentage of plastics are recycled in America?", answer: "5%"},
			{question: "How much less energy is required to make aluminum cans from recycled material than raw material?", answer: "95%"},
			{question: "How much of the world's data is stored on paper?", answer: "95%"},
			{question: "At least how low long will it take a plastic bottle to decompose?", answer: "500 years"},
			{question: "How many songs can you listen to on an iPod with the energy saved by recycling one aluminum can?", answer: "a full album"}
		
		];
var answers = [
	["300 years", "80 years", "6000 years", "4000 years"],
	["60 lb", "680 lb", "400 lb", "250 lb"],
	["70%", "80%","60%", "90%"],
	["50","16","80","100"],
	["aluminum","paper","plastic","glass"],
	["5%","10%","25%","28%"],
	["95%","25%", "68%","80%"],
	["95%","74%","48%","65%"],
	["25 years", "100 years","500 years","1000 years"],
	["4 songs", "8 songs", "20 songs", "a full album"]		
	
];
var Tquestions= questions;
var Tanswers= answers;

function getDate(){
		date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
		result = months[month]+' '+d+', '+year;
		document.getElementById("date").innerHTML=result;

}
function hideIbuttons()
{
	document.getElementById("check").style.display="none";
	document.getElementById("timedis").style.display= "none";
	document.getElementById("exit").style.display="none";
}
function showQuestion()
{
document.getElementById("timedis").style.display= "inline";
ind = Math.floor((Math.random() * Tquestions.length) + 1)-1;
document.getElementById("question").innerHTML=Tquestions[ind].question;
asked+=1;
}
function checkAnswer()
{
	var Vanswers
	var answered = false;
	var correct = false;
	Vanswers=document.getElementsByClassName("ch");
	if(Tquestions.length>0){
	for(var k = 0; k<Vanswers.length; k++)
	{
		if(Vanswers[k].checked==true)
		{
			answered=true;
		}
		if(Vanswers[k].value==Tquestions[ind].answer && Vanswers[k].checked==true)
		{
			correct = true;
		}
		
	}
	if(end==true && correct==true)
	{
		score+=1;
		document.getElementById("score").innerHTML="Score is: "+score;
		document.getElementById("message").innerHTML="Quiz Finished!";
		document.getElementById("check").style.display="none";
		document.getElementById("exit").style.display="none";
		document.getElementById("bar").style.visibility="hidden";
		document.getElementById("timedis").style.visibility="hidden";
		document.getElementById("submit").removeChild(document.getElementById("check"));
	}
	if(correct)
	{
	TotalSeconds=15;
	alert("correct");
	score+=1;
	document.getElementById("question").innerHTML="";
	clearAnswers();
	Tquestions.splice(ind,1);
	Tanswers.splice(ind,1);
	showQuestion();
	showAnswers();
	}
	else if(answered ==false)
	{
		alert("Choose an answer");
	}
	else
	{
	TotalSeconds=15;
	alert("incorrect");
	document.getElementById("question").innerHTML="";
	clearAnswers();
	Tquestions.splice(ind,1);
	Tanswers.splice(ind,1);
	showQuestion();
	showAnswers();
	}
	if(Tquestions.length==1)
		{
			end = true;
		}
	}
}
function showAnswers()
{
	started = true;
	document.getElementById("score").innerHTML="Score is: "+score;
	document.getElementById("check").style.display="inline";
	document.getElementById("exit").style.display="inline";
	var Vanswers=document.getElementsByClassName("ch");
	if(Tquestions.length>0)
	{
	showQuestion();
	var whereToAdd = document.getElementById("div2");
	var ulist = document.createElement("ul");
	ulist.className = 'choices';
	ulist.setAttribute('id','answeroptions');
	for (var i = 0; i < Tanswers[ind].length; ++i){
		var choice = document.createElement("input");
		choice.className = 'ch';
		choice.setAttribute('type','radio');
		choice.setAttribute('id','id'+i);
		choice.setAttribute('name','answer');
		choice.setAttribute('value',Tanswers[ind][i]);
		ulist.appendChild(choice);
		var answerLabel = document.createElement("label");  
		answerLabel.htmlFor = choice.id;  
		answerLabel.appendChild(choice); 
		var answerNameTextNode = document.createTextNode(Tanswers[ind][i]);
		answerLabel.appendChild(answerNameTextNode);  
		ulist.appendChild(answerLabel);
		var brElement = document.createElement("br");
		ulist.appendChild(brElement);
	}
	whereToAdd.appendChild(ulist);
	document.getElementById("start").style.display = "none";
	}

}
function clearAnswers(){
	var list=document.getElementById("div2");
	list.removeChild(document.getElementById("answeroptions"));
}
function exitQuiz(){
	
	document.getElementById("question").innerHTML="";
	document.getElementById("message").innerHTML="";
	document.getElementById("timedis").style.display= "none";
	started=false;
	score=0;
	document.getElementById("score").innerHTML="";
	Tanswers=answers;
	Tquestions = questions;
	getDate();
	hideIbuttons()
	clearAnswers();
	document.getElementById("bar").style.visibility="hidden";
	document.getElementById("start").style.display = "inline";
	TotalSeconds=15;

}