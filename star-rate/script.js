var rating = 0;
var one = document.querySelector('#one');
var two = document.querySelector('#two');
var three = document.querySelector('#three');
var four = document.querySelector('#four');
var five = document.querySelector('#five');
let form_rating = document.getElementById('rating');
function setRating(rating){
  form_rating.value = rating;
}
function on() {
  one.style.fill = '#ff3b3b';
  two.style.fill = '#000000';
  three.style.fill = '#000000';
  four.style.fill = '#000000';
  five.style.fill = '#000000';
  setRating(1);

};
function tw() {
  one.style.fill = '#ff8c3b';
  two.style.fill = '#ff8c3b';
  three.style.fill = '#000000';
  four.style.fill = '#000000';
  five.style.fill = '#000000';
  setRating(2);
};
function th() {
  one.style.fill = '#fcca03';
  two.style.fill = '#fcca03';
  three.style.fill = '#fcca03';
  four.style.fill = '#000000';
  five.style.fill = '#000000';
  setRating(3);
};
function fo() {
  one.style.fill = '#4d9e5c';
  two.style.fill = '#4d9e5c';
  three.style.fill = '#4d9e5c';
  four.style.fill = '#4d9e5c';
  five.style.fill = '#000000';
  setRating(4);
};
function fi() {
  one.style.fill = '#3ba0ff';
  two.style.fill = '#3ba0ff';
  three.style.fill = '#3ba0ff';
  four.style.fill = '#3ba0ff';
  five.style.fill = '#3ba0ff';
  setRating(5);
};
setRating(0);
var reviews = document.querySelector('.reviews');
var input = document.querySelector('.input');
function goto() {
  reviews.style.display = "initial";
  input.style.display = "none";
};
function goback() {
  reviews.style.display = "none";
  input.style.display = "initial";
};