<!-- resources/views/fare_result.blade.php -->

<div class="everything">
    <div class="allCont">
        <div class="data">
            <div class="fareConfirmationTitle">
                <h3>الأجرة المقدرة: ${{ $fare }}</h3>
                <p> مسافة: {{ $distance }} كيلومترات</p>
            </div>

            <div class="fareConfirmationContainer">
                <form action={{ route('confirmFareAr') }} method="post" class="fareConfirmationForm">
                    @csrf
                    <input type="text" name="fare" value="{{ $fare }}" hidden></input>
                    <input type="text" name="distance" value="{{ $distance }}" hidden></input>
                    <input type="text" name="location" value="{{ $location }}" hidden></input>
                    <input type="text" name="destination" value="{{ $destination }}" hidden></input>
                    <input type="text" name="name" placeholder="أدخل أسمك" required></input>
                    <input type="text" name="numb" placeholder="أدخل رقمك" pattern="[0-9]{8}"
                        title="يرجى إدخال رقم هاتف صالح (03123456)" required></input>
                    <button>تأكيد</button>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
    html {
        overflow: hidden;
    }

    .everything {
        background: #fff;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .allCont {
        background: #f3f3f3;
        padding: 20px;
        border: 1px solid #e8e8e8;
        border-radius: 50px;
        width: 300px;
        height: 450px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .data {
        width: fit-content;
        height: fit-content;
    }

    h3 {
        text-align: center;
        font-family: 'raleway';
        color: #DD001B;
    }

    p {
        font-family: 'raleway';
        color: #272727;
    }

    .fareConfirmationTitle {
        text-align: center
    }

    .fareConfirmationContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: fit-content;
    }

    .fareConfirmationForm {
        display: flex;
        flex-direction: column;
        height: fit-content;

    }

    input {
        margin: 10px 0px;
    }

    button {
        padding: 10px 20px;
        margin-right: 10px;
        border: none;
        border-radius: 5px;
        background-color: #DD001B;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #9e0114;
    }
</style>