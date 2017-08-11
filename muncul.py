import csv
from gensim.models import LdaModel
loading = LdaModel.load('model/stem/model_4_30_stem.model')
loadingcetak= loading.print_topics(num_topics=4, num_words=15)

with open('list_kata/daftar_kata_2topic_nostem.csv', 'w', newline='\n') as tulisFile:
    tulisFileWriter = csv.writer(tulisFile)
    for row in loadingcetak:
        tulisFileWriter.writerow([row])
tulisFile.close()

print (loadingcetak)