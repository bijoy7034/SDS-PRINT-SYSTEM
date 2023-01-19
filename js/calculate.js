document.querySelector('#amt').innerHTML = 0.00;

function calculate(){
    let adm = document.querySelector('#admis_no').value;
    let type = document.querySelector('#print').value;
    let add_ons = document.querySelector('#add_ons').value;
    let paper = document.querySelector('#paper').value;
    let copies = document.querySelector('#copies').value;
    var pg = 0;
    amt = 0;
    if(type== 'b&w'){
        if(paper == 'a4'){
            pg = 1;
            if(add_ons == 'none'){
                amt = pg * copies
            } else if(add_ons == 'hard'){
                amt = (pg * copies) + 125;
            }
            else if(add_ons == 'soft'){
                amt = (pg * copies) +40;
            }else{
                amt = (pg*copies)+70
            }
        }else{
            pg = 8;
            if(add_ons == 'none'){
                amt = pg * copies
            } else if(add_ons == 'hard'){
                amt = (pg * copies) + 125;
            }
            else if(add_ons == 'soft'){
                amt = (pg * copies) +40;
            }else{
                amt = (pg*copies)+70
            }
        }

    }else{
        if(paper == 'a4'){
            pg = 10;
            if(add_ons == 'none'){
                amt = pg * copies
            } else if(add_ons == 'hard'){
                amt = (pg * copies) + 125;
            }
            else if(add_ons == 'soft'){
                amt = (pg * copies) +40;
            }else{
                amt = (pg*copies)+70
            }
        }else{
            pg = 20;
            if(add_ons == 'none'){
                amt = pg * copies
            } else if(add_ons == 'hard'){
                amt = (pg * copies) + 125;
            }
            else if(add_ons == 'soft'){
                amt = (pg * copies) +40;
            }else{
                amt = (pg*copies)+70
            }
        }
    }
    document.querySelector('#amt').innerHTML = amt;

}
