  //live porfile image

  var loadFile = function(event) {
    var output = document.getElementById('getUserAvatar');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };

  var loadFile2 = function(event) {
    var output2 = document.getElementById('getlogo');
    output2.src = URL.createObjectURL(event.target.files[0]);
    output2.onload = function() {
      URL.revokeObjectURL(output2.src) // free memory
    }
  };
// fix arabic languge in pdf
  function processDoc(doc) {
    pdfMake.fonts = {
       Arial: {
              normal:'arial.ttf',
              bold: 'arial.ttf',
          },
    };

    doc.defaultStyle.font = "Arial";

  }

    //لو تم الضغط على اي حدا كلاسه Confirm
    $(document).on("click",".Confirm",function(){
        //شغلي المودال الي اسمه Confirm
        $("#Confirm").modal("show");
        //تغيير الرابط تاع زر التأكيد الى الرابط تاع الزر الي انضغط عليه
        $("#Confirm .btn-danger").attr("href",$(this).attr("href"));
        //ما تكمل وتحذف عن جد
        return false;
    });


    //make input number 2 number Decimal
    const setTwoNumberDecimal = (el) => {
        el.value = parseFloat(el.value).toFixed(2);
      };

      const handleInput = (e) => {
        if (e.inputType == "deleteContentBackward") {
          return;
        }
        setTwoNumberDecimal(e.target);
      };

      const handleBlur = (e) => {
        if (e.target.value !== "") {
          setTwoNumberDecimal(e.target);
        }
      };


// date format

var date = $('.fc-datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

