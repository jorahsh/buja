from justwatch import JustWatch
from omdb import OMDBClient
import json

client = OMDBClient(apikey='253fd7b3')
just_watch = JustWatch(country='US')
results = just_watch.search_for_item(providers=['nfx'])
file = open('movies.sql', 'a')
for item in results['items']:
    omdb_data = client.get(title=item['title'],year=item['original_release_year'],fullplot=False,tomatoes=False)
    runtime = '{} minutes'.format(item['runtime']) if 'runtime' in item else '{} seasons'.format(item['max_season_number'])
    title = item['title'].replace("'","''")
    language = omdb_data['language'] if 'language' in omdb_data else item['original_language']
    poster = omdb_data['poster'] if 'poster' in omdb_data else './sad_jack.jpg'
    genre = omdb_data['genre'] if 'genre' in omdb_data else 'no genre'
    description = omdb_data['plot'].replace("'","''")[:191] if 'plot' in omdb_data else item['short_description'].replace("'","''")[:191];
    insert = "INSERT INTO movie (id, title, rating, year, runtime, language, poster, genre, description) VALUES ({},'{}','{}',{},'{}','{}','{}','{}','{}');".format(item['id'],title,item['age_certification'], item['original_release_year'],runtime,language,poster,genre,description)
    file.write(insert)
    file.write('\n')
