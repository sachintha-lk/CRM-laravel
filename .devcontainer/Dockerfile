#-------------------------------------------------------------------------------------------------------------
# Copyright (c) Microsoft Corporation. All rights reserved.
# Licensed under the MIT License. See https://go.microsoft.com/fwlink/?linkid=2090316 for license information.
#-------------------------------------------------------------------------------------------------------------

FROM php:7-cli

# Avoid warnings by switching to noninteractive
ENV DEBIAN_FRONTEND=noninteractive

# This Dockerfile adds a non-root 'vscode' user with sudo access. However, for Linux,
# this user's GID/UID must match your local user UID/GID to avoid permission issues
# with bind mounts. Update USER_UID / USER_GID if yours is not 1000. See
# https://aka.ms/vscode-remote/containers/non-root-user for details.
ARG USERNAME=vscode
ARG USER_UID=1000
ARG USER_GID=$USER_UID

# Configure apt and install packages
RUN apt-get update \
    && apt-get -y install --no-install-recommends apt-utils dialog 2>&1 \
    && apt-get -y install curl git iproute2 procps lsb-release unzip zip openssl gnupg \

    # Install xdebug
    #&& yes | pecl install xdebug \
    #&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    #&& echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    #&& echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \

    # Create a non-root user to use if preferred - see https://aka.ms/vscode-remote/containers/non-root-user.
    && groupadd --gid $USER_GID $USERNAME \
    && useradd -s /bin/bash --uid $USER_UID --gid $USER_GID -m $USERNAME \
    # [Optional] Add sudo support for the non-root user
    && apt-get install -y sudo \
    && echo $USERNAME ALL=\(root\) NOPASSWD:ALL > /etc/sudoers.d/$USERNAME\
    && chmod 0440 /etc/sudoers.d/$USERNAME

# Install Composer from: https://hub.docker.com/_/composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN  echo 'export PATH="$PATH:$HOME/.composer/vendor/bin:/root/.composer/vendor/bin:vendor/bin"' >> /root/.bashrc
RUN  curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN  apt-get install -y nodejs
RUN apt-get install -y libzip-dev \
    && docker-php-ext-configure zip  \
    && docker-php-ext-install zip \
    && docker-php-ext-install bcmath mysqli pdo pdo_mysql
RUN  su $USERNAME -c "composer global require laravel/installer"
RUN  echo "alias art='php artisan'" >> /root/.bashrc && \
     echo "alias serve='php artisan serve --port=8000 --host=0.0.0.0'" >> /root/.bashrc && \
     echo "alias ls='ls -B -h --color=auto -ltr'" >> /root/.bashrc && \
     echo "alias _='sudo'" >> /root/.bashrc  && \
     echo "alias apt='sudo apt'" >> /root/.bashrc  && \
     echo "alias apt-get='sudo apt-get'" >> /root/.bashrc

# Switch back to dialog for any ad-hoc use of apt-get
ENV DEBIAN_FRONTEND=
