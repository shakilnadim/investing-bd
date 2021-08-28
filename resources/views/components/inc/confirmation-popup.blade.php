<div class="fixed bg-gray-700 bg-opacity-50 top-0 left-0 w-full h-full" @click.self="showConfirmationPopup=false">
    <div class="fixed p-5 bg-white border rounded left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <p x-text="message" class="text-lg"></p>
        <div class="flex justify-center items-center gap-2 mt-3">
            <form :action="url" method="post">
                @csrf
                <input type="hidden" name="_method" x-model="method">
                <x-inc.dynamic-btn type="submit" x-text="confirmBtnText" ::class="confirmBtnClass + ' text-lg font-bold capitalize'"></x-inc.dynamic-btn>
            </form>
            <x-inc.dynamic-btn x-text="cancelBtnText" @click="showConfirmationPopup=false" ::class="cancelBtnClass + ' text-lg font-bold capitalize'"></x-inc.dynamic-btn>
        </div>
    </div>
</div>
