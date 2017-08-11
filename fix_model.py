import csv
from gensim import corpora,models 
# import warnings
# warnings.filterwarnings(action='ignore', category=UserWarning, module='gensim')
import gensim
from sklearn.decomposition import LatentDirichletAllocation as LDA
from nltk.tokenize import RegexpTokenizer
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
# create stemmer
hasil=[]
i=0
tokenizer = RegexpTokenizer(r'\w+')
with open('4.data_diapain.csv') as raw:
    reader = csv.reader(raw)
    for row in reader:
        asli = ''.join(row)
        cinta = tokenizer.tokenize(asli)
        hasil.append(cinta)
        i=i+1
        # print(i)
#         print(tokenizer.tokenize(hasil))
#         stopped_tokens = [i for i in asli if not i in indo_stop]
#         print(stopped_tokens)
#         forename = hasil

raw.close()

dictionary = corpora.Dictionary(hasil)
    # convert tokenized documents into a document-term matrix
corpus = [dictionary.doc2bow(text) for text in hasil]
ldamodel = gensim.models.ldamodel.LdaModel(corpus, num_topics=5, id2word = dictionary, passes=30)
tampil=ldamodel.print_topics(-1)


print(tampil)

# lda = LDA(n_topics=10)
# lda.fit(ldamodel.print_topics(num_topics=5, num_words=2))
# training_features = lda.transform(training_data)
# testing_features = lda.transform(testing_data)
# print(lda)

with open('5.Fix', 'w') as tulisFile:
    tulisFileWriter = csv.writer(tulisFile)
    for row in tampil:
        tulisFileWriter.writerow([row])

    tulisFile.close()