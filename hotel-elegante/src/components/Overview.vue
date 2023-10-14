<script setup>

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

                <div class="clientReview">
                    <Avatar image="https://i.ibb.co/mXWWrQV/female2.png" class="mr-2 customAvatar" shape="circle" />

                    <div class="review">
                        <div class="reviewParagraph">

                        </div>
                    </div>

                    <div class="stars">

                    </div>
                </div>
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

                <div class="clientReview">
                    <Avatar image="https://i.ibb.co/0GqgmcB/male1.png" class="mr-2 customAvatar" shape="circle" />


                    <div class="review">
                        <div class="reviewParagraph">

                        </div>
                    </div>

                    <div class="stars">
                        
                    </div>
                </div>
            </div>
            <div class="image" id="restaurant"></div>
        </div>
       

        <div class="group">
            <div class="image" id="pool"></div>
            <div class="description">
                <div class="descrTitle title">
                    Luxury Suite
                </div>

                <div class="descrParagraph">
                    Each suite at Hotel Elegante promises a stay of pure luxury. A king-sized bed with premium linens takes center stage, flanked by a cozy 
                    seating area. A private balcony offers sweeping city views, while modern amenities ensure an unparalleled stay.
                </div>

                <div class="clientReview">
                    <Avatar image="https://i.ibb.co/jZhPqCz/male2.png" class="mr-2 customAvatar" shape="circle" />


                    <div class="review">
                        <div class="reviewParagraph">

                        </div>
                    </div>

                    <div class="stars">
                        
                    </div>
                </div>
            </div>
        </div>
        

        <div class="group">
            <div class="description">
                <div class="descrTitle title">
                    Indoor Pool
                </div>

                <div class="descrParagraph">
                    An oasis of tranquility within the hotel, the indoor pool offers a serene relaxation experience. Crystal clear waters mirror the 
                    ornate ceiling, creating an ethereal ambiance. Lounge chairs and tropical plants surround the pool, with soft lighting adding a touch of serenity.
                </div>

                <div class="clientReview">
                    <Avatar image="https://i.ibb.co/dkPBvnK/female1.png" class="mr-2 customAvatar" shape="circle" />

                    <div class="review">
                        <div class="reviewParagraph">

                        </div>
                    </div>

                    <div class="stars">
                        
                    </div>
                </div>
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
    position: relative;  /* Rende il descrParagraph un elemento padre posizionato per gli pseudo-elementi */
    padding: 30px;
}

.clientReview{
    margin: 0 auto;
    margin-top: 20px;
    padding: 15px;
    width: 90%;
    height: 100px;
    border: 1px solid #b97533;
    border-radius: 15px;
    display: flex;
    align-items: center;
}

.customAvatar {
    width: 80px;
    height: 80px;
    line-height: 80px; /* Questo è per centrare il contenuto, se hai un testo o un'icona all'interno */
}


</style>