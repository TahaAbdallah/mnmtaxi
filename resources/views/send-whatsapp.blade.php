<!-- resources/views/contact.blade.php -->
<form method="post" action="{{ route('send.whatsapp') }}">
    @csrf
    <input type="date" name="date" required><br>
    <input type="time" name="time_slot_1" required><br>
    <input type="time" name="time_slot_2" required><br>
    <input type="text" name="phone_number" placeholder="Your Phone Number" required><br>
    <button type="submit">Submit</button>
</form>