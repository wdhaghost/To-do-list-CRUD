
document.getElementById("nav-burger").addEventListener("click",function(event){
    document.getElementById("main-nav-list").classList.toggle("active")
    document.getElementById("nav-arrow").classList.toggle("active")
    this.classList.toggle("active")
})

document.getElementById("nav-arrow").addEventListener("click",function(event){
    document.getElementById("main-nav-list").classList.toggle("active")
    document.getElementById("nav-burger").classList.toggle("active")
    this.classList.toggle("active")
   
})

if(document.getElementById("pop-up")){
    document.getElementById("pop-up").classList.add("active");
    
    setTimeout(function(event){ document.getElementById("pop-up").classList.remove("active")},3000)

}