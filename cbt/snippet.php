            $("a").click(function(e){
            e.preventDefault();
            let eid= "<?=$getExams['exam_id']?>";
            let q= "aq";
            let qn= "<?=$getExams['num_quest']?>";
            let cid= "<?=$getExams['subjects']?>";
            let url="questions.php?q="+ q + "&eid=" +eid + "&qn=" + qn+ "&cid=" + cid;
           alert(url);
        });
