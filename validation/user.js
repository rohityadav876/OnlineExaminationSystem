//function to handle login-form validation
function loginValidate(loginForm){

var validationVerified=true;
var errorMessage="";

if (loginForm.login.value=="")
{
errorMessage+="Username not filled!\n";
validationVerified=false;
}
if(loginForm.password.value=="")
{
errorMessage+="Password not filled!\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
return validationVerified;
}

//function to handle register-form validation
function registerValidate(registerForm){

var validationVerified=true;
var errorMessage="";

if (registerForm.fname.value=="")
{
errorMessage+="Firstname not filled!\n";
validationVerified=false;
}
if(registerForm.lname.value=="")
{
errorMessage+="Lastname not filled!\n";
validationVerified=false;
}
if (registerForm.login.value=="")
{
errorMessage+="Email not filled!\n";
validationVerified=false;
}
if(registerForm.password.value=="")
{
errorMessage+="Password not provided!\n";
validationVerified=false;
}
if(registerForm.cpassword.value=="")
{
errorMessage+="Confirm password not filled!\n";
validationVerified=false;
}
if(registerForm.cpassword.value!=registerForm.password.value)
{
errorMessage+="Password and Confirm Password do not match!\n";
validationVerified=false;
}
if (!isValidEmail(registerForm.login.value)) {
errorMessage+="Invalid email address provided!\n";
validationVerified=false;
}
if(registerForm.question.selectedIndex==0)
{
errorMessage+="Question not selected!\n";
validationVerified=false;
}
if(registerForm.answer.value=="")
{
errorMessage+="Answer not filled!\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
return validationVerified;
}

//validate email function
function isValidEmail(val) {
	var re = /^[\w\+\'\.-]+@[\w\'\.-]+\.[a-zA-Z]{2,}$/;
	if (!re.test(val)) {
		return false;
	}
    return true;
}

//validate special PIN
function isValidSpecialPIN(val) {
	var re = /^[0-9][0-9][A-Z][A-Z][A-Z][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/;
	if (!re.test(val)) {
		return false;
	}
	return true;
}

//validate special PIN length
function isValidLength(val){
	var length = 12;
	if (!re.test(val)) {
		return false;
	}
	return true;
}

//function to handle passwordResetForm validation
function passwordResetValidate(resetForm){

var validationVerified=true;
var errorMessage="";

if (resetForm.email.value=="")
{
errorMessage+="Please enter your account email! We need your email in order to reset your password.\n";
validationVerified=false;
}
if (!isValidEmail(resetForm.email.value)) {
errorMessage+="Invalid email address provided!\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
return validationVerified;
}

//function to handle passwordResetForm validation(2)
function passwordResetValidate_2(resetForm){

var validationVerified=true;
var errorMessage="";

if (resetForm.answer.value==""){
errorMessage+="Please enter your security answer to your provided security question.\n";
validationVerified=false;
}
if (resetForm.new_password.value==""){
errorMessage+="New Password not set!\n";
validationVerified=false;
}
if (resetForm.confirm_new_password.value==""){
errorMessage+="Confirm New Password not set!\n";
validationVerified=false;
}
if (resetForm.new_password.value!=resetForm.confirm_new_password.value){
errorMessage+="New Password and Confirm New Password do not match!\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
return validationVerified;
}

//validate updateForm
function updateValidate(updateForm) {
    var validationVerified=true;
var errorMessage="";

if (updateForm.opassword.value=="")
{
errorMessage+="Please provide your old password.\n";
validationVerified=false;
}
if (updateForm.npassword.value=="")
{
errorMessage+="Please provide a new password.\n";
validationVerified=false;
}
if(updateForm.cpassword.value=="")
{
errorMessage+="Please confirm your new password.\n";
validationVerified=false;
}
if(updateForm.cpassword.value!=updateForm.npassword.value)
{
errorMessage+="Confirm Password and New Password do not match!\n";
validationVerified=false;
}
if(!validationVerified)
{
alert(errorMessage);
}
return validationVerified;
}

//reset password popup
 function resetPassword()
 {
window.open('password-reset.php','resetPassword','toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=no,copyhistory=no,scrollbars=yes,width=480,height=320');
 }

//live clock function
function updateClock ( )
{
  var currentTime = new Date ( );

  var currentHours = currentTime.getHours ( );
  var currentMinutes = currentTime.getMinutes ( );
  var currentSeconds = currentTime.getSeconds ( );

  // Pad the minutes and seconds with leading zeros, if required
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  // Choose either "AM" or "PM" as appropriate
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  // Convert the hours component to 12-hour format if needed
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  // Convert an hours component of "0" to "12"
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  // Compose the string for display
  var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

  // Update the time display
  document.getElementById("clock").innerHTML = currentTimeString;
}