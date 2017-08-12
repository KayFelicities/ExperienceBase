"""tras doc/ppt to pdf"""
import os
import glob
import time
from win32com import client as wc

WORK_FILE_PATH = 'E:\\Seafile\\ExBaseFiles\\content_files'

def file_scan():
    """file_scan"""
    files = glob.glob(os.path.join(WORK_FILE_PATH, '*.doc'))\
                + glob.glob(os.path.join(WORK_FILE_PATH, '*.docx'))\
                + glob.glob(os.path.join(WORK_FILE_PATH, '*.ppt'))\
                + glob.glob(os.path.join(WORK_FILE_PATH, '*.pptx'))
    for file in files:
        pdf_file = '.'.join(file.split('.')[:-1]) + '.pdf'
        if os.path.isfile(pdf_file):
            continue
        print('trans ' + file)
        if file.split('.')[-1] in ['doc', 'docx']:
            try:
                word = wc.Dispatch('Word.Application')
                doc = word.Documents.Open(file)
                doc.SaveAs(pdf_file, 17)
                doc.Close()
                word.Quit()
                os.system('233 ' + pdf_file)
            except Exception:
                print('doc trans error')
        elif file.split('.')[-1] in ['ppt', 'pptx']:
            try:
                ppt = wc.Dispatch('PowerPoint.application')
                doc = ppt.Presentations.Open(file)
                doc.SaveAs(pdf_file, 32)
                doc.Close()
                ppt.Quit()
                os.system('233 ' + pdf_file)
            except Exception:
                print('error')


if __name__ == '__main__':
    while True:
        file_scan()
        time.sleep(10)
