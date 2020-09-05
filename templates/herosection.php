


<style>
.bodycontent{
  display: grid;
  grid-template-columns: 70% 30%;
  grid-gap: 1em;
}
.bodycontent div{
  background-color: #eee;
  padding:30px;
  border-radius: 3px;
}
.bodycontent div:nth-child(odd){
  background-color: #ddd;
}

.bodycontent .one{
  grid-column-start: 1;
  grid-column-end:3;
  padding:0;
  margin:0 auto;

}
.bodycontent .one img{
  width: 100%;
  max-height: 700px;
}

</style>


<div class="bodycontent">
  <div class="one">
      <img src="../templates/imgs/bookstore.jpg" alt="hero">
  </div>

</div> <!--END WRAPPER -->
