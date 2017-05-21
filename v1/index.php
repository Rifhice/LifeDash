<!doctype html>
<html lang="fr" ng-app="LifeDash">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LifeDashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="Style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>
  <body>

    <!-- Blue sky    https://www.youtube.com/watch?v=ybUCGFPQPsg
         Few clouds  https://www.youtube.com/watch?v=ZFhxjv1Ck-s
         More Clouds https://www.youtube.com/watch?v=-guCzD9g5fA
         Rain        https://www.youtube.com/watch?v=scw_RUTBt8w
         Night sky   https://www.youtube.com/watch?v=Kf4GkHsRB2w
    -->
    <video playsinline autoplay muted loop poster="" id="bgvid">
        <source src="Assets/Deep Blue Sky - Clouds Timelapse - Free Footage - Full HD 1080p.mp4" type="video/mp4">
    </video>

    <div ng-controller="DataController as weather" class="container">
      <p class="currentDay"> {{weather.weatherInfo[0]['day']}} </p>
      <p class="currentTemp"> {{weather.weatherInfo[0]['temp']}} </p>
      <img id="weatherIcon" class="currentIcon" ng-src="{{weather.weatherInfo[0]['icon']}}"/>
    </div>


  <div class="container" ng-controller="DataController as data" style="width: 50%; display: table;">
    <div style="display: table-row">
        <div class="elementTab" ng-repeat="day in data.scheduleInfo" style="display: table-cell;">
          <p class="textTab"> {{day["date"]}}<br> </p>
          <p class="textTab" ng-show="data.weatherInfo[$index]['temp_max'] != undefined"> {{data.weatherInfo[$index]["temp_max"]}} / {{data.weatherInfo[$index]["temp_min"]}}</p>
          <p class="textTab" ng-repeat="event in day">
            {{event["summary"]}}<br>
            {{event["start"]}}
            {{event["end"]}}
            {{event["location"]}}
          </p>
        </div>
    </div>
</div>

<section style="position: fixed;width: 45%;margin-left: 55%;top: 0;margin-top: 3%;"
        ng-controller="PanelController as panel">

  <ul class="nav nav-pills navPan">
    <li ng-class="{active:panel.isSelected(1)}">
      <a href ng-click="panel.selectTab(1)">Muscu</a>
    </li>
    <li ng-class="{active:panel.isSelected(2)}">
      <a href ng-click="panel.selectTab(2)">News</a>
    </li>
    <li ng-class="{active:panel.isSelected(3)}">
      <a href ng-click="panel.selectTab(3)">Note jour</a>
    </li>
  </ul>

  <div class="tab-content tabContent">

    <!-- Onglet Musculation -->
    <div class="panel panContent" ng-show="panel.isSelected(1)">
      <section ng-controller="InnerPanelController as innerPanel" class="scroll">
        <!-- Ecran affichage des Séances de musculation -->
        <div ng-show="innerPanel.isSelected(0)">
          <div ng-controller="SeanceController as seances" style=" display: table-cell;">
            <button type="button"  ng-click="innerPanel.selectTab(5)" class="btn btn-info">Exercices</button>
            <button type="button"  ng-click="innerPanel.setSeance(data['IdSeance']);innerPanel.selectTab(3)" class="btn btn-info">Ajouter seance</button>
            <button type="button"  ng-click="seances.refresh()" class="btn btn-info">Refresh</button>
            <div ng-repeat="data in seances.seanceInfo['data']">
              <p class="titreSeance" > {{data["Titre"]}} </p>
              <p class="objectifSeance" > {{data["Objectif"]}} </p>
              <button type="button"  ng-click="innerPanel.setSeance(data['IdSeance']);innerPanel.selectTab(1)" class="btn btn-info">Info</button>
              <button type="button"  ng-click="seances.delete(data['IdSeance'])" class="btn btn-info">Supprimer</button>
              <button type="button"  ng-click="innerPanel.setSeance(data['IdSeance']);innerPanel.selectTab(4)" class="btn btn-info">Modifier</button>
              <button type="button"  ng-click="innerPanel.setSeance(data['IdSeance']);innerPanel.selectTab(8)" class="btn btn-info">Ajouter perf</button>
            </div>
          </div>
        </div>
        <!-- Details d'une séance de Musculation -->
        <div ng-controller="AffiliationsController as affiliation" style=" display: table-cell;" ng-show="innerPanel.isSelected(1)">
          <div ng-repeat="data in affiliation.affiliations['data']" >
            <div ng-show="innerPanel.isSeanceSelected(data['IdSeance'])">
              <p class="infoButton">
                {{data["Titre"]}}
              </p>
              <p  type="button"  ng-click="affiliation.delete(data['IdSeance'],data['IdExercice'])" class="btn btn-info" >Supprimer</p>
            </div>
          </div>
          <p  type="button"  ng-click="innerPanel.selectTab(2)" class="btn btn-info" >Ajout exo</p>
          <p  type="button"  ng-click="innerPanel.selectTab(0)" class="btn btn-info" >Retour</p>
          <p  type="button"  ng-click="affiliation.refresh()" class="btn btn-info">Refresh</p>
        </div>
        <!-- Ecran d'ajout d'un exercices a une séance -->
        <div ng-controller="AffiliationsController as affiliations">
          <div ng-controller="ExerciceController as exercice" style=" display: table-cell;" ng-show="innerPanel.isSelected(2)">
            <select ng-model="selectedExercices">
              <option ng-repeat="id in exercice.exercices['data']" value="{{id['IdExercice']}}">{{id['Titre']}}</option>
            </select>
            <p  type="button"  ng-click="affiliations.addAffiliation(innerPanel.getSeance(),selectedExercices);innerPanel.selectTab(1)" class="btn btn-info" >Ajouter</p>
            <p  type="button"  ng-click="innerPanel.selectTab(0)" class="btn btn-info" >Retour</p>
            <p  type="button"  ng-click="exercice.refresh()" class="btn btn-info">Refresh</p>
          </div>
        </div>
        <!-- Ajout d'une séance de musculation -->
        <div ng-controller="SeanceController as seance" ng-show="innerPanel.isSelected(3)" style=" display: table-cell;">
            <label>Titre : <input type="text" ng-model="seance.titre" /></label>
            <label>Objectif : <input type="text" ng-model="seance.objectif" /></label>
            <p  type="button"  ng-click="innerPanel.selectTab(0);seance.addSeance(seance.titre,seance.objectif)" class="btn btn-info" >Valider</p>
            <p  type="button"  ng-click="innerPanel.selectTab(0)" class="btn btn-info" >Retour</p>
        </div>
        <!-- Modification d'une séance de musculation -->
        <div ng-controller="SeanceController as seance" ng-show="innerPanel.isSelected(4)" style=" display: table-cell;">
            <label>Titre : <input type="text"  ng-model="seance.getSeanceById(innerPanel.idCurrentSeance)['Titre']" /></label>
            <label>Objectif : <input type="text" ng-model="seance.getSeanceById(innerPanel.idCurrentSeance)['Objectif']" />{{}}</label>
            <p  type="button"  ng-click="innerPanel.selectTab(0);seance.update(innerPanel.idCurrentSeance,seance.getSeanceById(innerPanel.idCurrentSeance)['Titre'],seance.getSeanceById(innerPanel.idCurrentSeance)['Objectif'])" class="btn btn-info" >Valider</p>
            <p  type="button"  ng-click="innerPanel.selectTab(0)" class="btn btn-info" >Retour</p>
        </div>
        <!-- Liste des exercices de musculation -->
        <div ng-show="innerPanel.isSelected(5)">
          <div ng-controller="ExerciceController as exercice" style=" display: table-cell;">
            <button type="button"  ng-click="innerPanel.selectTab(0)" class="btn btn-info">Seances</button>
            <button type="button"  ng-click="innerPanel.selectTab(6)" class="btn btn-info">Ajouter exercice</button>
            <button type="button"  ng-click="exercice.refresh()" class="btn btn-info">Refresh</button>
            <div ng-repeat="data in exercice.exercices['data']">
              <p class="titreSeance" > {{data["Titre"]}}  </p>
              <p class="objectifSeance" > {{data["Description"]}} </p>
              <button type="button"  ng-click="exercice.delete(data['IdExercice'])" class="btn btn-info">Supprimer</button>
              <button type="button"  ng-click="innerPanel.setExercice(data['IdExercice']);innerPanel.selectTab(7)" class="btn btn-info">Modifier</button>
              <button type="button"  ng-click="innerPanel.setExercice(data['IdExercice']);innerPanel.selectTab(9)" class="btn btn-info">Add perf</button>
            </div>
          </div>
        </div>
        <!-- Ajout d'un exercice de musculation -->
        <div ng-controller="ExerciceController as exercice" ng-show="innerPanel.isSelected(6)" style=" display: table-cell;">
          <form>
            <label>Titre : <input type="text" ng-model="exercice.titre" /></label>
            <label>Description : <input type="text" ng-model="exercice.description" /></label>
            <select ng-model="selectedType">
              <option ng-repeat="id in exercice.typeExercice['data']" value="{{id['IdType']}}">{{id['type']}}</option>
            </select>
          </form>
            <p  type="button"  ng-click="innerPanel.selectTab(5);exercice.add(exercice.titre,exercice.description,selectedType)" class="btn btn-info" >Valider</p>
            <p  type="button"  ng-click="innerPanel.selectTab(5)" class="btn btn-info" >Retour</p>
        </div>
        <!-- Modification d'un exercice de musculation -->
        <div ng-controller="ExerciceController as exercice" ng-show="innerPanel.isSelected(7)" style=" display: table-cell;">
            <label>Titre : <input type="text"  ng-model="exercice.getExerciceById(innerPanel.idCurrentExercice)['Titre']"/></label>
            <label>Description : <input type="text" ng-model="exercice.getExerciceById(innerPanel.idCurrentExercice)['Description']"/></label>
            <p  type="button"  ng-click="innerPanel.selectTab(5);exercice.update(innerPanel.idCurrentExercice,exercice.getExerciceById(innerPanel.idCurrentExercice)['Titre'],exercice.getExerciceById(innerPanel.idCurrentExercice)['Description'])" class="btn btn-info" >Valider</p>
            <p  type="button"  ng-click="innerPanel.selectTab(5)" class="btn btn-info" >Retour</p>
        </div>
        <!-- Ajout d'une performance a un exercice en lien avec une séance -->
        <div ng-controller="AffiliationsController as affiliation" style=" display: table-cell;" ng-show="innerPanel.isSelected(8)">
          <div ng-repeat="data in affiliation.affiliations['data']" >
            <div ng-show="innerPanel.isSeanceSelected(data['IdSeance'])">
              <p class="infoButton">
                {{data["Titre"]}}
              </p>
              <div ng-controller="ExerciceController as exercice" ng-show="exercice.isCharge(exercice.getExerciceById(data['IdExercice'])['Type'])">
                  <label>Series : <input required type="number"  ng-init="perf.series = 0" ng-model="perf.series"/></label>
                  <label>Repetition : <input required type="number" ng-init="perf.repetition = 0" ng-model="perf.repetition"/></label>
                  <label>Charge : <input required type="number" ng-init="perf.charge = 0" ng-model="perf.charge"/></label>
                <p  type="button"  ng-click="exercice.addChargePerf(data['IdExercice'],perf.series,perf.repetition,perf.charge,innerPanel.getSeance());perf.series = 0;perf.repetition = 0;perf.charge = 0" class="btn btn-info" >Valider</p>
              </div>
              <div ng-controller="ExerciceController as exercice" ng-show="exercice.isTemps(exercice.getExerciceById(data['IdExercice'])['Type'])">
                  <label> Durée </label>
                  <label>Min : <input required type="number" ng-init="perf.tempsMinute = 0" ng-model="perf.tempsMinute"/></label>
                  <label>Sec : <input required type="number" ng-init="perf.tempsSeconde = 0" ng-model="perf.tempsSeconde"/></label>
                  <p  type="button"  ng-click="exercice.addTimePerf(data['IdExercice'],((perf.tempsMinute * 60) + perf.tempsSeconde),innerPanel.getSeance());perf.tempsSeconde = 0;perf.tempsMinute = 0" class="btn btn-info" >Valider</p>
              </div>
            </div>
          </div>
          <p  type="button"  ng-click="innerPanel.selectTab(0)" class="btn btn-info" >Retour</p>
          <p  type="button"  ng-click="affiliation.refresh()" class="btn btn-info">Refresh</p>
        </div>
        <!-- Ajout d'une performance sans rapport a une séance -->
        <div ng-controller="ExerciceController as exercice" style=" display: table-cell;" ng-show="innerPanel.isSelected(9)">
              <p class="infoButton">
                {{exercice.getExerciceById(innerPanel.getExercice())["Titre"]}}
              </p>
              <div ng-show="exercice.isCharge(exercice.getExerciceById(innerPanel.getExercice())['Type'])">{{data}}
                  <label>Series : <input required type="number"  ng-init="perf.series = 0" ng-model="perf.series"/></label>
                  <label>Repetition : <input required type="number" ng-init="perf.repetition = 0" ng-model="perf.repetition"/></label>
                  <label>Charge : <input required type="number" ng-init="perf.charge = 0" ng-model="perf.charge"/></label>
                <p  type="button"  ng-click="exercice.addChargePerf(innerPanel.getExercice(),perf.series,perf.repetition,perf.charge);innerPanel.selectTab(5)" class="btn btn-info" >Valider</p>
              </div>
              <div ng-show="exercice.isTemps(exercice.getExerciceById(innerPanel.getExercice())['Type'])">
                  <label> Durée </label>
                  <label>Min : <input required type="number" ng-init="perf.tempsMinute = 0" ng-model="perf.tempsMinute"/></label>
                  <label>Sec : <input required type="number" ng-init="perf.tempsSeconde = 0" ng-model="perf.tempsSeconde"/></label>
                  <p  type="button"  ng-click="exercice.addTimePerf(innerPanel.getExercice(),((perf.tempsMinute * 60) + perf.tempsSeconde));innerPanel.selectTab(5)" class="btn btn-info" >Valider</p>
              </div>
            </div>
      </section>
    </div>

    <!-- Onglet News -->
    <div class="panel panContent" ng-show="panel.isSelected(2)">

      <div ng-controller="DataController as data" style=" display: table-cell;">
        <div ng-repeat="news in data.newsInfo">
          <p class="textNews" > {{news["title"]}} </p>
          <img class="imgNews" ng-src="{{news['urlToImage']}}"/>
        </div>
      </div>

    </div>

    <!-- Onglet Note jour -->
    <div class="panel panContent" ng-show="panel.isSelected(3)">

      <h3>Menu 2</h3>
      <p>Some content in menu 2.</p>

    </div>

</section>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script type="text/javascript" src="Script/date.js"></script>
    <script type="text/javascript" src="Script/data.js"></script>
  </body>
</html>
