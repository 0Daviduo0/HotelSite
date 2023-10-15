<script setup>
import ReviewComponent from './ReviewComponent.vue';

</script>

<template>

    <div class="title">
        An Hotel like never before
    </div>

    <div class="overview">

        <div class="group">
            <div class="image" id="entrance"></div>
            <div class="description">
                <div class="descrTitle title">
                    Lobby
                </div>

                <div class="descrParagraph">
                    Upon entering Hotel Elegante, guests are greeted with a grand and spacious lobby. High ceilings adorned with crystal chandeliers 
                    shine down upon gleaming marble floors. Plush seating areas offer relaxation spots, while a grand staircase beckons exploration to 
                    the upper levels. Potted palm trees add a touch of natural greenery, rounding off the elegant atmosphere.
                </div>

                <ReviewComponent 
                    avatarImage="https://i.ibb.co/mXWWrQV/female2.png" 
                    reviewText="Stepped into the lobby and was instantly blown away by its grandeur. 
                                The chandeliers and marble floors give such a luxurious feel. Truly 
                                a majestic welcome!"
                    :rating="5" 
                />

            </div>
        </div>

        
        <div class="group">
            <div class="description">
                <div class="descrTitle title">
                    Dining Room
                </div>

                <div class="descrParagraph">
                    The dining room at Hotel Elegante exudes opulence. Elegant wooden tables set with fine china and silverware await guests for an 
                    unforgettable culinary experience. Large windows grant breathtaking views of the sunset, while attentive staff ensure impeccable service.
                </div>

                <ReviewComponent 
                    avatarImage="https://i.ibb.co/0GqgmcB/male1.png" 
                    reviewText="Dined with a sunset view. The ambiance was top-notch, and the staff were 
                                extremely attentive. A memorable dining experience!" 
                    :rating="5"
                />

            </div>
            <div class="image" id="restaurant"></div>
        </div>
       

        <div class="group">
            <div class="image" id="pool"></div>
            <div class="description">
                <div class="descrTitle title">
                    Indoor Pool 
                </div>

                <div class="descrParagraph">
                    An oasis of tranquility within the hotel, the indoor pool offers a serene relaxation experience. Crystal clear waters mirror the 
                    ornate ceiling, creating an ethereal ambiance. Lounge chairs and tropical plants surround the pool, with soft lighting adding a touch of serenity.
                </div>

                <ReviewComponent 
                    avatarImage="https://i.ibb.co/dkPBvnK/female1.png" 
                    reviewText="The indoor pool was a dream. Swimming under that ornate ceiling with the 
                                soft lighting was so relaxing. A must-try!" 
                    :rating="4.5"
                />

            </div>
        </div>
        

        <div class="group">
            <div class="description">
                <div class="descrTitle title">
                    Luxury Suite
                </div>

                <div class="descrParagraph">
                    Each suite at Hotel Elegante promises a stay of pure luxury. A king-sized bed with premium linens takes center stage, flanked by a cozy 
                    seating area. A private balcony offers sweeping city views, while modern amenities ensure an unparalleled stay.
                </div>

                <ReviewComponent 
                    avatarImage="https://i.ibb.co/jZhPqCz/male2.png" 
                    reviewText="The suite was the epitome of comfort and luxury. Loved the balcony views and 
                                the plush bedding. Felt like royalty!" 
                    :rating="5"
                />

            </div>
            <div class="image" id="bedrooms"></div>
        </div>

    </div>

</template>

<style scooped>

.title{
    margin-top: 50px;
    margin-bottom: 50px;
}

.overview {
    display: flex;
    flex-direction: column;
    border-radius: 20px;
    overflow: hidden;
    justify-content: center;
    align-items: center;
}

.group{
    display: flex;
    width: 100%;
    height: 400px;
}

.image{
    width: 50%;
    overflow: hidden;
    border-radius: 20px;
    object-position: 25% 25%; 
}

#entrance{
    background-image: url("../assets/images/hotelInteriors/entrance.png");
    background-position: 50%;
    background-repeat: repeat;
}

#restaurant{
    background-image: url("../assets/images/hotelInteriors/restaurant.png");
    background-position: 50%;
    background-repeat: repeat;
}

#pool{
    background-image: url("../assets/images/hotelInteriors/pool.png");
    background-position: 50%;
    background-repeat: repeat;
}

#bedrooms{
    background-image: url("../assets/images/hotelInteriors/bedrooms.png");
    background-position: 50%;
    background-repeat: repeat;
}

.description{
    width: 50%;
    display: flex;
    flex-direction: column;
    padding: 15px;
}

.descrTitle{
    margin-top: 20px !important;
    margin-bottom: 20px !important;
}

.descrParagraph::before, .descrParagraph::after {
    content: url("../assets/symbols/sparkles.svg");
    position: absolute;
    opacity: 0.3;  /* Imposta l'opacità come desideri, 0.3 è solo un esempio */
    z-index: -1;   /* Assicura che le virgolette stiano dietro al testo */
}

.descrParagraph::before {
    top: 0;
    left: 0;
    transform: rotate(15deg);
}

.descrParagraph::after {
    bottom: 0;
    right: 30px;
    transform: scaleX(-1) rotate(15deg);

}

.descrParagraph {
    position: relative;
    padding: 30px;
}
</style>