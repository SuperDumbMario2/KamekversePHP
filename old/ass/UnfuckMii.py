import os
import re
import requests
import sys
from urllib.parse import urlparse

def download_file(url, save_path):
    if os.path.exists(save_path):
        print(f"File already exists, skipping download: {save_path}")
        return

    response = requests.get(url)
    if response.status_code == 200:
        with open(save_path, 'wb') as f:
            f.write(response.content)
        print(f"Downloaded: {url} -> {save_path}")
    else:
        print(f"Failed to download: {url}")

def process_css_file(css_path, save_directory):
    with open(css_path, 'r') as css_file:
        css_content = css_file.read()

    url_pattern = re.compile(r'url\(([^)]+)\)')
    urls = url_pattern.findall(css_content)

    for url in urls:
        url = url.strip('\'\"')
        parsed_url = urlparse(url)
        if parsed_url.scheme in ('http', 'https'):
            filename = os.path.basename(parsed_url.path)
            local_path = os.path.join(save_directory, filename)
            download_file(url, local_path)
            css_content = css_content.replace(url, './' + filename)

    with open(css_path, 'w') as css_file:
        css_file.write(css_content)

    print(f"Processed CSS file: {css_path}")

if __name__ == '__main__':
    if len(sys.argv) != 3:
        print("Usage: python script.py path/to/your.css /path/to/save/directory")
        sys.exit(1)

    css_file_path = sys.argv[1]
    save_directory = sys.argv[2]

    # Correcting any potential issues in the directory path
    save_directory = os.path.normpath(save_directory.strip('\'\"'))
    if not os.path.exists(save_directory):
        os.makedirs(save_directory)

    process_css_file(css_file_path, save_directory)
