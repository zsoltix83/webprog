    function My_funct(){
//        document.getElementById('my_div').innerHTML="Hello!";
        alert('Müködik!');
    }
    
    function valami(){
    alert('Hali!');   
    }
     
    function Ellenorizz(){
      if(document.getElementById('my_box').checked){
          My_funct();
      }
      
      setTimeout(Ellenorizz(),1000);
    }
