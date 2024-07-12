<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container">
        <form>
            <div class="form-group">
                <label>Họ và tên</label>
                <input class="form-control" placeholder="Ho va ten" id="name"/>
            </div>
            <div class="form-group">
                <label>SDT</label>
                <input class="form-control" placeholder="SDT" type="tel" id="phone"/>
            </div>
            <div class="form-group">
                <label>ND</label>
                <textarea  class="form-control" placeholder="ND can tu van" id="content"></textarea>
            </div>
            <button id="submit" type="submit" class="btn btn-default btn-danger">Submit</button>
        </form>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded",() => {
        const name = document.getElementById("name");
        const phone = document.getElementById("phone");
        const content = document.getElementById("content");
        const submit = document.getElementById("submit");
        submit.addEventListener("click", (e) => {
            e.preventDefault();
            const data = {
                name: name.value,
                phone: phone.value,
                content: content.value,
            };
            postGoogle(data);            
            alert("Đăng ký thành công! Vui lòng kiểm tra email!");
        });
        async function postGoogle(data){
            const fomrURL = 
            "https://docs.google.com/forms/d/e/1FAIpQLSdxHAp0oE0_gLSF63L9EajUV-xMWEtV4zBB5XS6OO52ArhQ8Q/formResponse";
            const formData = new FormData();
            formData.append("entry.244717613", data.name);
            formData.append("entry.211756531", data.phone);
            formData.append("entry.2051417840", data.content);
            await fetch(fomrURL, {
                method: "POST",
                body: formData,
            }
            );
        }
    }
    );

</script>
</html>