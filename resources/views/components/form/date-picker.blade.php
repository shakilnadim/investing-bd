@props(['label', 'labelFor', 'name', 'value'])
<div {{ $attributes->merge(['class' => 'antialiased sans-serif']) }}>
    <div x-data="datePicker" x-cloak>
        <div class="">
            <div class="">
                <label for="{{ $labelFor }}">{{ $label }}</label>
                <div class="relative">
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}" x-ref="date" />
                    <input
                        type="text"
                        readonly
                        x-model="datepickerValue"
                        @click="showDatepicker = !showDatepicker"
                        @keydown.escape="showDatepicker = false"
                        class="w-full pl-4 pr-10 py-3 leading-none rounded shadow-sm border-gray-300 focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                        placeholder="Select date"
                    />

                    <div class="absolute top-0 right-0 px-3 py-2" @click="showDatepicker = !showDatepicker">
                        <svg
                            class="h-6 w-6 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                    </div>

                    <!-- <div x-text="no_of_days.length"></div>
                                    <div x-text="32 - new Date(year, month, 32).getDate()"></div>
                                    <div x-text="new Date(year, month).getDay()"></div> -->

                    <div
                        class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0 z-10"
                        style="width: 17rem"
                        x-show.transition="showDatepicker"
                        @click.away="showDatepicker = false"
                    >
                        <div class="flex justify-between items-center mb-2">
                            <div>
                              <span
                                  x-text="monthNames[month]"
                                  class="text-lg font-bold text-gray-800"
                              ></span>
                                <span
                                    x-text="year"
                                    class="ml-1 text-lg text-gray-600 font-normal"
                                ></span>
                            </div>
                            <div>
                                <button
                                    type="button"
                                    class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                    @click="previousYearMonth(); getNoOfDays()"
                                >
                                    <svg
                                        class="h-6 w-6 text-gray-500 inline-flex"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 19l-7-7 7-7"
                                        />
                                    </svg>
                                </button>
                                <button
                                    type="button"
                                    class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                    @click="nextYearMonth(); getNoOfDays()"
                                >
                                    <svg
                                        class="h-6 w-6 text-gray-500 inline-flex"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-3 -mx-1">
                            <template x-for="(day, index) in days" :key="index">
                                <div style="width: 14.26%" class="px-1">
                                    <div
                                        x-text="day"
                                        class="text-gray-800 font-medium text-center text-xs"
                                    ></div>
                                </div>
                            </template>
                        </div>

                        <div class="flex flex-wrap -mx-1">
                            <template x-for="blankday in blankdays">
                                <div
                                    style="width: 14.28%"
                                    class="text-center border p-1 border-transparent text-sm"
                                ></div>
                            </template>
                            <template
                                x-for="(date, dateIndex) in no_of_days"
                                :key="dateIndex"
                            >
                                <div style="width: 14.28%" class="px-1 mb-1">
                                    <div
                                        @click="getDateValue(date)"
                                        x-text="date"
                                        class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': doesDateMatch(date) == true, 'text-gray-700 hover:bg-blue-200': doesDateMatch(date) == false }"
                                    ></div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @error($name)
    <div class="text-red-800 text-sm">{{ $message }}</div>
    @enderror
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('datePicker', () => ({
            monthNames: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
            showDatepicker: false,
            datepickerValue: "",
            month: "",
            year: "",
            dateValue: "",
            no_of_days: [],
            blankdays: [],
            days: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

            init() {
                this.initDate();
                this.getNoOfDays();
                this.getDateValue(this.dateValue);
            },

            initDate() {
                let date = this.$refs.date.value;
                if (date){
                    date = new Date(date);
                } else {
                    date = new Date();
                }

                this.year = date.getFullYear();
                this.month = date.getMonth();
                this.dateValue = date.getDate();
                this.datepickerValue = new Date(
                    this.year,
                    this.month,
                    this.dateValue
                ).toDateString();
            },

            doesDateMatch(date) {
                const value = new Date(this.year, this.month, this.dateValue);
                const d = new Date(this.year, this.month, date);

                return value.toDateString() === d.toDateString();
            },

            getDateValue(date) {
                let selectedDate = new Date(this.year, this.month, date);
                this.datepickerValue = selectedDate.toDateString();

                this.$refs.date.value =
                    selectedDate.getFullYear() +
                    "-" +
                    ("0" + (selectedDate.getMonth() + 1)).slice(-2) +
                    "-" +
                    ("0" + selectedDate.getDate()).slice(-2);

                this.showDatepicker = false;
            },

            getNoOfDays() {
                let daysInMonth = new Date(
                    this.year,
                    this.month + 1,
                    0
                ).getDate();

                // find where to start calendar day of week
                let dayOfWeek = new Date(this.year, this.month).getDay();
                let blankdaysArray = [];
                for (let i = 1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i);
                }

                let daysArray = [];
                for (let i = 1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }

                this.blankdays = blankdaysArray;
                this.no_of_days = daysArray;
            },

            previousYearMonth() {
                this.month--;
                if(this.month === -1) {
                    this.month = 11;
                    this.year--;
                }
            },

            nextYearMonth() {
                this.month++;
                if(this.month === 12) {
                    this.month = 0;
                    this.year++;
                }
            }
        }))
    })
</script>
