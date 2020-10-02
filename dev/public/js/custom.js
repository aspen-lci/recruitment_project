function resetPass(){
  confirm("Do you wish to reset the password for id " + document.getElementById("clearPass").value + "?" );
};

 // polyfill for RegExp.escape
 if(!RegExp.escape) {
  RegExp.escape = function(s) {
    return String(s).replace(/[\\^$*+?.()|[\]{}]/g, '\\$&');
  };
}