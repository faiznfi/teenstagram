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
with open('data/2.data_training_no_stem.csv') as raw:
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
dictionary.save('dictionary/dictionary.dict')
corpus = [dictionary.doc2bow(text) for text in hasil]
corpora.MmCorpus.serialize('dictionary/corpora.mm', corpus)

logging.basicConfig(filename='rekap_model/rekapmodel_4_30.csv', filemode='w',format='%(asctime)s : %(levelname)s : %(message)s', level=logging.INFO)
#logging.basicConfig(format='%(asctime)s : %(levelname)s : %(message)s', level=logging.INFO)
from gensim import corpora, models, similarities
from gensim.models import ldamodel
for i in range(1):
    lda_a = ldamodel.LdaModel(corpus, id2word=dictionary, num_topics=4, passes=15, alpha='auto')
    lda_a.save('model/no_stem/model_4_30_nostem.model')
    # lda_a.print_topics(-1)p

