const dropDownHandler = () => {
    const myElement = document.getElementById('my-dropdown');
    const dropIcon = document.getElementById('drop-icon');
    myElement.toggleAttribute("hidden");
    // console.log(myElement.getAttribute("hidden"));
   if(myElement.getAttribute("hidden") != null){
    dropIcon.classList.add("fa-caret-up");
    dropIcon.classList.remove("fa-caret-down");
   } else{
    dropIcon.classList.remove("fa-caret-up");
    dropIcon.classList.add("fa-caret-down");
   }
}