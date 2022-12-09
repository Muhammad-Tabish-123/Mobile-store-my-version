
let cart=[];
let addTocartEle= document.querySelector('#addToCartBtn');
let removeTocartEle= document.querySelector('#removeToCartBtn');
let amountEle =parseInt(document.querySelector('#value').innerHTML);
console.log(amountEle);
console.log(addTocartEle);
console.log(removeTocartEle);

cart.forEach(el => {
    if(el === amountEle){
        addTocartEle.classList.toggle('hidden');
        removeTocartEle.classList.toggle('hidden');
    }
});

addTocartEle.addEventListener('click',function(){
    console.log('cilck 1');
    cart.push(amountEle);
    console.log('added');
    addTocartEle.classList.toggle('hidden');
        removeTocartEle.classList.toggle('hidden');
})

removeTocartEle.addEventListener('click',function(){
    console.log('cilck 2');
    cart.forEach((el,i) => {
        if(el === amountEle){
            cart[i]=0;          
        }
        addTocartEle.classList.toggle('hidden');
        removeTocartEle.classList.toggle('hidden');
    console.log('removed');
})
})
console.log('u');

