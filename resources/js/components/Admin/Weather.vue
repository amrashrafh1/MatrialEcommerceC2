
<template>
    <div class=" column header">
        <div>
            <div class="" id="weatherApp">
                <h4 class="text-center"  v-show="city">{{ city }}</h4>
                <span class="text-center d-block bold uppercase font-dark" v-show="curTempDisplay">{{ weatherMain }}: {{ weatherDesc }}</span>
                <h2 v-show="curTempDisplay">
                    <img id="wicon" :src="'http://openweathermap.org/img/w/'+ icon + '.png'" alt="Weather icon" style="width: 70px;">
                    {{ curTempDisplay }}
                    <span class="btn" style="padding:4px 10px;" :class="{ 'btn-deactivate': displayMode }"  @click="getTemp(0)">°C</span> |
                    <span class="btn" style="padding:4px 10px;" :class="{ 'btn-deactivate': !displayMode }"  @click="getTemp(1)">°F</span>
                </h2>
                <span v-show="!curTempDisplay" class=""><i class="fa fa-refresh" title="Click to refresh" @click="getLocation"></i></span>
            </div>
    </div>
    </div>
</template>

<script>
    import axios from 'axios';
    var CELSIUS = 0, FAHRENHEIT = 1;
    export default {
        name:'weather',
    data()
    {
        return {
            latitude: 0.0,
            longitude: 0.0,
            city: 'Hello from MELBOURNE',
            curTemp: null,
            displayMode: CELSIUS,
            dataObj: null,
            weatherMain: 'Fine',
            weatherDesc: 'Clear day',
            errorMsg: '',
            icon:null
        }
    },
        created() {
            this.getLocation();
    this.getWeather();
        },
    computed: {
        classWI: function() {
            if (this.dataObj != null){
                var weatherID = this.dataObj.weather[0].id;
                if (weatherID >= 200 && weatherID <= 232) {
                    return 'wi-thunderstorm';
                } else if (weatherID >= 300 && weatherID <= 321) {
                    return 'wi-sprinkle';
                } else if (weatherID >= 500 && weatherID <= 531) {
                    return 'wi-rain';
                } else if (weatherID >= 600 && weatherID <= 622) {
                    return 'wi-snow';
                } else if (weatherID >= 701 && weatherID <= 781) {
                    return 'wi-train';
                } else if(weatherID == 800) {
                    return 'wi-moon-alt-new';
                } else if (weatherID >= 801 && weatherID <= 804) {
                    return 'wi-cloud';
                } else if (weatherID >= 900 && weatherID <= 962) {
                    return 'wi-small-craft-advisory';
                }
            }
            return '';
        },
        curTempDisplay: function() {
            if (this.curTemp != null) {
                if (this.displayMode == CELSIUS) {
                    return (this.curTemp - 273.15).toFixed(1);
                } else {
                    return (this.curTemp * 9/5 - 459.67).toFixed(1);
                }
            } else {
                return null;
            }
        },
    },
        ready: function() {
        this.getLocation();
        console.log('App ready!');
    },
    methods: {
        getTemp: function(option) {
            this.displayMode = option;
        },
        getLocation: function() {
            if (!navigator.geolocation) {
                this.errorMsg = "Geolocation is not supported by your browser";
                this.city = this.errorMsg;
                console.warn(this.errorMsg);
                return;
            }
            console.log('Getting current position..');
            var options = {timeout:60000};
            navigator.geolocation.getCurrentPosition(this.success, this.error, options);
        },
        success: function(position) {
            this.latitude = position.coords.latitude;
            this.longitude = position.coords.longitude;
            this.latitude = parseFloat(this.latitude).toFixed(2);
            this.longitude = parseFloat(this.longitude).toFixed(2);

            this.getWeather();
        },
        error: function(err) {
            this.errorMsg = "Unable to retrieve your location";
            this.city = this.errorMsg;

            console.warn(`ERROR(${err.code}): ${err.message}`);
            console.warn(this.errorMsg);
        },
        getWeather: function() {
            var reqURL = 'http://api.openweathermap.org/data/2.5/weather?lat=' + this.latitude + '&lon=' + this.longitude + '&APPID=2bc5576a68f25f11357e0efe63e42256';
            var thi = this;
            axios.get(reqURL).then(function(response) {
                thi.dataObj = response.data;
                thi.curTemp = response.data.main.temp;
                thi.city = thi.dataObj.name;
                thi.weatherMain = thi.dataObj.weather[0].main;
                thi.weatherDesc = thi.dataObj.weather[0].description;
                thi.icon = thi.dataObj.weather[0].icon
            }, function(response) {
                console.log(response);
            });
        },
        /*
        getWeather() {
            let url = "http://api.openweathermap.org/data/2.5/weather?q=London&?units=metric&APPID=2bc5576a68f25f11357e0efe63e42256";
            axios
                .get(url)
                .then(response => {
                    this.currentTemp = response.data.main.temp;
                    this.minTemp = response.data.main.temp_min;
                    this.maxTemp = response.data.main.temp_max;
                    this.pressure = response.data.main.pressure;
                    this.humidity = response.data.main.humidity + '%';
                    this.wind = response.data.wind.speed + 'm/s';
                    this.overcast = response.data.weather[0].description;
                    this.icon = "images/" + response.data.weather[0].icon.slice(0, 2) + ".svg";
                    this.sunrise = new Date(response.data.sys.sunrise*1000).toLocaleTimeString("en-GB").slice(0,4);
                    this.sunset = new Date(response.data.sys.sunset*1000).toLocaleTimeString("en-GB").slice(0,4);
                })
                .catch(error => {
                    console.log(error);
                })
        }*/

    }
    }
</script>


<style lang="sass" scoped>

</style>
