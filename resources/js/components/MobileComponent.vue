<template>
    <div class="container mobile-app">

        <img src="/images/pdparis-black-logo.png">
        <p>Шаг: {{ step }}</p>

        <div v-if="step === 1" class="step">
            <h1>Бонжур!</h1>
            <p>Дайте відповідь всього на 5 питань, а я підберу для вас персональний аромат та подарую знижку до 90% на весь асортимент.</p>
            <p><small>*Знижка діє тільки в оффлайн-магазині.</small></p>

            <button @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 2" class="step">
            <h1>Давайте знайомитись — вкажіть ваші стать та вік</h1>
            <p>Це важливі критерії у виборі персонального аромату, який надалі стане вашою візитною карткою.</p>
            <p><input type="radio" v-model="answers.sex" value="мужской"> мужской</p>
            <p><input type="radio" v-model="answers.sex" value="женский"> женский</p>
            <p><input type="text"  v-model="answers.age"> возвраст</p>

            <button @click="decreaseStep()">Назад</button>
            <button @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 3" class="step">
            <h1>Який у вас тип характеру?</h1>
            <p>Парфуми мають віддзеркалювати внутрішнє «я» свого власника, тому важливо підкреслити ароматними нотами саме ваші риси характеру.</p>
            <p><input type="radio" v-model="answers.temperament" value="меланхолик"> Меланхолик - ранимый, сдержанный в речи человек. Они обладают высокой чувствительностью нервной системы, что присуще творческим натурам </p>
            <p><input type="radio" v-model="answers.temperament" value="холерик"> Холерик - горячий, импульсивный, стремительно реагирующий на ситуацию</p>
            <p><input type="radio" v-model="answers.temperament" value="флегматик"> Флегматик - медлительный, спокойный, с постоянным настроением</p>
            <p><input type="radio" v-model="answers.temperament" value="сангвиник"> Сангвиник - отличается высокой работоспособностью, энергичностью и порой слишком легким отношением к проблемам</p>

            <button @click="decreaseStep()">Назад</button>
            <button @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 4" class="step">
            <h1>Яку пору року ви полюбляєте найбільше?</h1>
            <p>Таким чином я зможу визначити, наскільки насиченим має бути ваш аромат.</p>
            <p><input type="radio" v-model="answers.time" value="зима"> зима </p>
            <p><input type="radio" v-model="answers.time" value="весна"> весна</p>
            <p><input type="radio" v-model="answers.time" value="лето"> лето</p>
            <p><input type="radio" v-model="answers.time" value="осень"> осень</p>

            <button @click="decreaseStep()">Назад</button>
            <button @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 5" class="step">
            <h1>Який тип аромату вам подобається?</h1>
            <p>Виходячи з ваших уподобань, я підберу ідеальний аромат для вас.</p>
            <p><input type="checkbox" v-model="answers.aromat" value="свежие"> Свежие </p>
            <p><input type="checkbox" v-model="answers.aromat" value="сладкие"> Сладкие</p>
            <p><input type="checkbox" v-model="answers.aromat" value="цитрусовые"> Цитрусовые</p>
            <p><input type="checkbox" v-model="answers.aromat" value="цветочные"> Цветочные</p>
            <p><input type="checkbox" v-model="answers.aromat" value="древесные"> Древесные</p>
            <p><input type="checkbox" v-model="answers.aromat" value="фруктовые"> Фруктовые</p>

            <button @click="decreaseStep()">Назад</button>
            <button @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 6" class="step">
            <h1>Розкажіть мені про ваш улюблений аромат?</h1>
            <p>Я знайду схожі композиції, щоб урізноманітнити ваш парфумерний гардероб. Вкажіть у формі нижче, що вас приваблює в ароматах.
            </p>
            <p><textarea v-model="answers.notes"></textarea></p>

            <button @click="decreaseStep()">Назад</button>
            <button @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 7" class="step">
            <h1>Вітаю! Ви успішно пройшли тест :)</h1>

            <button @click="decreaseStep()">Назад</button>
            <button @click="increaseStep()">Далі</button>
        </div>

    </div>
</template>

<script>
export default {
    data () {
        return {
            step: 1,
            phone: '',
            answers: {
                sex: 'женский',
                age: 1,
                aromat: [],
                temperament: '',
                time: 'зима',
                notes: '',
            },
        }
    },

    mounted() {
        this.step = 1;
    },

    methods: {
        increaseStep() {
            this.step++;
        },
        decreaseStep() {
            this.step--;
        }
    }
}
</script>
<style lang="scss">
    .mobile-app {
        text-align:center;
        max-width:760px;
        min-width:320px;
        width:100%;
        margin: 0 auto;
        border: 1px dashed silver;
        padding: 10px;
    }
</style>
