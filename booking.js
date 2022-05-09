function dif(){
  let date1=document.getElementById("dateFromid").value;
  let date2=document.getElementById("dateFromid").value;

  let diff=date1-date2/1000*60*60*24;
  console.log(diff);

  document.getElementById("difference").value="";
  document.getElementById("difference").value=diff;
}
 
 function addPeople(){
    let people=document.getElementById("peopleNum").value;
    people++;
      if(people<100){
        document.getElementById("peopleNum").value="";
        document.getElementById("peopleNum").value=people;
      }
      else{
        document.getElementById("peopleNum").value="";
        document.getElementById("peopleNum").value=1;  
      }
   }
  function lessPeople(){
    let people=document.getElementById("peopleNum").value;
     people--;
     if(people>=1){
     document.getElementById("peopleNum").value="";
     document.getElementById("peopleNum").value=people;
     }
     else{
     document.getElementById("peopleNum").value="";
     document.getElementById("peopleNum").value=1;  
     }
  }


   $(document).ready(function () {
    $('#dtHorizontalExample').DataTable({
      "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');
  });

   