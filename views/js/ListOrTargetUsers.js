const targets = document.querySelectorAll('.mode');
const btnList = document.getElementById('list');
const btnGrid = document.getElementById('grid');

const modeView = document.querySelectorAll('.target-users');

btnList.addEventListener('click', function(){
    if(targets){
        const targetsArray = Array.from(targets);
        targetsArray.forEach((target) => {
            target.className = "mode col-12";
        });
    }
    if(modeView){
        const modeViewsArray = Array.from(modeView);
        modeViewsArray.forEach((view) => {
            view.className = "target-users mode-list";
        });
    }
    btnList.className = 'btn btn-light'
    btnGrid.className = 'btn btn-outline-light';
});

btnGrid.addEventListener('click', function(){
    if(targets){
        const targetsArray = Array.from(targets);
        targetsArray.forEach((target) => {
            target.className = "mode col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6";
        });
    }
    if(modeView){
        const modeViewsArray = Array.from(modeView);
        modeViewsArray.forEach((view) => {
            view.className = "target-users mode-grid";
        });
    }
    btnGrid.className = 'btn btn-light'
    btnList.className = 'btn btn-outline-light';
});