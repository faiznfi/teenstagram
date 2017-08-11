import csv
from gensim import corpora
import logging
import gensim

from sklearn.decomposition import LatentDirichletAllocation as LDA
from nltk.tokenize import RegexpTokenizer
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
# create stemmer
hasil=[]
i=0
tokenizer = RegexpTokenizer(r'\w+')
with open('data/2.data_training_with_stem.csv') as raw:
    reader = csv.reader(raw)
    for row in reader:
        asli = ''.join(row)
        cinta = tokenizer.tokenize(asli)
        hasil.append(cinta)
        i=i+1

#         print(tokenizer.tokenize(hasil))
#         stopped_tokens = [i for i in asli if not i in indo_stop]
#         print(stopped_tokens) \
#         forename = hasil

raw.close()
dictionary = corpora.Dictionary(hasil)
dictionary.save('dictionary/dictionary_stem.dict')
corpus = [dictionary.doc2bow(text) for text in hasil]
corpora.MmCorpus.serialize('dictionary/corpora_stem.mm', corpus)

raw.close()

print(dictionary)

# logging.basicConfig(format='%(asctime)s : %(levelname)s : %(message)s', level=logging.INFO)
# from gensim import corpora, models, similarities
# from gensim.models import ldamodel for i in range (3):
#     lda_a = ldamodel.LdaModel(corpus, num_topics=5, passes=30, alpha='auto', eval_every=5)

with open('data/list_dictionary.csv', 'w', newline='') as tulisFile:
    tulisFileWriter = csv.writer(tulisFile)
    for row in dictionary.token2id:
        tulisFileWriter.writerow([row])