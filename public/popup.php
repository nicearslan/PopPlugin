<div id="modal">
    <div class="modalconent">
        <h1></h1>

        <p>fasfsdfasfsfsdfsdfsdsffsd</p>
        <button id="button">Close</button>
    </div>
</div>

<style>
    #modal {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 99999;
        height: 100%;
        width: 100%;
    }
    
    .modalconent {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        width: 80%;
        padding: 20px;
    }
</style>

<script>
    window.onload = function() {
        document.getElementById('button').onclick = function() {
            document.getElementById('modal').style.display = "none"
        };
    };
</script>