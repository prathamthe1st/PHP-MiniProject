function ValidateEmail()
{
	inputEmail = document.getElementById("regemail").value;
console.log(inputEmail);
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(inputEmail.match(mailformat))
{
alert("Valid email address!");
// document.form1.text1.focus();
return true;
}
else
{
alert("You have entered an invalid email address!");
document.form1.text1.focus();
return false;
}
 }