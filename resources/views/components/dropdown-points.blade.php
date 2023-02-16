<style>
    .dropbtn {
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        float: right;
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        /*background-color: #f1f1f1;*/
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        right: 0px;
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        background-color: white;
    }

    .dropdown a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }
</style>

<div class="control-buttons text-gray-500 text-[18px] flex justify-end space-x-6 mr-6 items-center h-full">
    <i class="fa-solid fa-magnifying-glass"></i>
    <div class="dropdown">
        <i class="fa-solid fa-ellipsis-vertical dropbtn" onclick="dropdownСontent()"></i>
        <div id="myDropdown" class="dropdown-content">
            <a href="#" class="group-chat">Групповой чат</a>
        </div>
    </div>
</div>


<script>
    let chatCheck = false;

    document.addEventListener('DOMContentLoaded', function () {
        window.onclick = function (event) {
            console.log(!event.target.matches('.dropbtn'));
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        let groupChat = document.querySelector('.group-chat');
        let individualChats = document.querySelectorAll('.individual-chat');

        groupChat.addEventListener('click', function () {
            if (!chatCheck) {
                individualChats.forEach(function (chat) {
                   chat.style.display = 'block';
                });

                chatCheck = true;
            } else {
                individualChats.forEach(function (chat) {
                    chat.style.display = 'none';
                });

                chatCheck = false;
            }
        })
    });

    function dropdownСontent() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
</script>
