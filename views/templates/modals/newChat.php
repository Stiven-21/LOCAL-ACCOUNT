<!-- Modal -->
<div class="modal fade" id="newChat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-search-chat">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-modal" id="exampleModalLabel">Search user</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <div class="row justify-content-evenly">
                <div class="col-12 col-md-11 col-lg-10 mb-3 mt-1">
                    <div class="search">
                        <input type="text" class="searchInput" placeholder="Search..." name="search" id="search" autocomplete="off">
                        <div class="searchIcon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-11 col-lg-10 mb-1">
                    <div class="container-scroll-chats" id="container-scroll-chats">
                        <div class="modal-target-user" id="-1" >
                            <div class="text-modal-not-user">Enter the name or identification number</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <h1 class="text-modal fs-6">Start a new chat</h1>
        </div>
        </div>
    </div>
</div>