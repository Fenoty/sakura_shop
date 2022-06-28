
//переход в категории
document.querySelector('.buket').addEventListener('click', ()=>{
    window.location.href = './pages/kategories/buket.php?page=1';
});
document.querySelector('.kompozitsii').addEventListener('click', ()=>{
    window.location.href = './pages/kategories/kompozitsii.php?page=1';
});
document.querySelector('.japanflowers').addEventListener('click', ()=>{
    window.location.href = './pages/kategories/japanflowers.php?page=1';
});
document.querySelector('.roomflowers').addEventListener('click', ()=>{
    window.location.href = './pages/kategories/roomflowers.php?page=1';
});
document.querySelector('#logo').addEventListener('click', ()=>{
    window.location.href = '/index.php';
});