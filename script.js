const menuBar =document.querySelector('.menu_bar')
const  menuBarIcon=document.querySelector('menu_bar i')
const dropDown =document.querySelector('.drop_down')

menuBar.onclik = function(){
    dropDown.classList.toggle('open')
}