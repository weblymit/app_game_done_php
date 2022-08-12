 <!-- The button to open modal -->
 <label for="my-modal" class="btn btn-error btn-md text-white modal-button">Supprimer</label>
 <!-- Put this part before </body> tag -->
 <input type="checkbox" id="my-modal" class="modal-toggle" />
 <div class="modal">
   <div class="modal-box">
     <h3 class="font-bold text-xl text-center ">Voulez-vous vraiment supprimer ?</h3>
     <div class="flex justify-center space-x-5 pt-5">
       <div class="modal-action">
         <label for="my-modal" class="btn ">Non</label>
       </div>
       <div class="modal-action">
         <label for="my-modal" class="btn btn-primary">
           <a href="delete.php?id=<?= $game["id"] ?>&name=<?= $game["name"] ?>" class="">Oui</a>
         </label>
       </div>
     </div>
   </div>
 </div>